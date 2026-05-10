@extends('layouts.app')

@section('title', 'Manage Sacred Chants')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <div class="d-flex justify-content-between align-items-center px-4">
                                <h6 class="text-white text-capitalize ps-3">Sacred Chants</h6>
                                <button type="button" class="btn bg-gradient-dark mb-0" onclick="openCreateModal()">
                                    <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Chant
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0" id="chants-table-container">
                            @include('chants.partials.table', ['chants' => $chants])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Create/Edit -->
    <div class="modal fade" id="chantModal" tabindex="-1" role="dialog" aria-labelledby="chantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="chantModalLabel">Add Sacred Chant</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    <!-- Form will be loaded here via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCreateModal() {
            $.get("{{ route('admin.chants.create') }}", function(data) {
                $('#modal-body-content').html(data);
                $('#chantModalLabel').text('Add Sacred Chant');
                $('#chantModal').modal('show');
            });
        }

        function openEditModal(id) {
            $.get("/admin/chants/" + id + "/edit", function(data) {
                $('#modal-body-content').html(data);
                $('#chantModalLabel').text('Edit Sacred Chant');
                $('#chantModal').modal('show');
            });
        }

        $(document).on('submit', '#chant-form', function(e) {
            e.preventDefault();
            let form = $(this);
            let url = form.attr('action');
            let method = form.find('input[name="_method"]').val() || 'POST';

            $.ajax({
                url: url,
                type: method,
                data: form.serialize(),
                success: function(response) {
                    if (response.success) {
                        $('#chantModal').modal('hide');
                        reloadTable();
                        Swal.fire('Success', response.message, 'success');
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '';
                    $.each(errors, function(key, value) {
                        errorMsg += value[0] + '<br>';
                    });
                    Swal.fire('Error', errorMsg, 'error');
                }
            });
        });

        function deleteChant(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/chants/" + id,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                reloadTable();
                                Swal.fire('Deleted!', response.message, 'success');
                            }
                        }
                    });
                }
            })
        }

        function reloadTable() {
            $.get("{{ route('admin.chants.index') }}", function(data) {
                $('#chants-table-container').html(data);
            });
        }
    </script>
@endsection
