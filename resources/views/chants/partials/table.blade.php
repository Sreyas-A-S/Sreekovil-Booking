<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chant Text</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Meaning</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
            <th class="text-secondary opacity-7"></th>
        </tr>
    </thead>
    <tbody>
        @forelse($chants as $chant)
            <tr>
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-col justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $chant->text }}</h6>
                        </div>
                    </div>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0 text-wrap" style="max-width: 300px;">{{ $chant->meaning ?? 'N/A' }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                    <span class="badge badge-sm {{ $chant->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                        {{ $chant->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="align-middle">
                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" onclick="openEditModal({{ $chant->id }})">
                        Edit
                    </a>
                    <a href="javascript:;" class="text-danger font-weight-bold text-xs ms-3" onclick="deleteChant({{ $chant->id }})">
                        Delete
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center py-4">
                    <p class="text-xs font-weight-bold mb-0">No chants found. Add some sacred verses!</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
