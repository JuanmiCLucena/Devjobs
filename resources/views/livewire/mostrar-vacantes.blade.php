<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @if (count( $vacantes ) > 0 )
        @foreach ($vacantes as $vacante)
        <div class="p-6 text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
            <div class="leading-10">
                <a href="{{ route('vacantes.show', $vacante->id)}}" class="text-xl font-bold">
                    {{ $vacante->titulo }}
                </a>
                <p class="text-sm text-gray-300 font-bold">{{ $vacante->empresa }}</p>
                <p class="text-sm text-gray-200">Último día: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
            </div>

            <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                <a href="{{ route('candidatos.index', $vacante) }}"
                    class="bg-slate-500 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    {{ $vacante->candidatos->count() }}
                    Candidatos
                </a>
                <a href="{{ route('vacantes.edit', $vacante->id )}}"
                    class="bg-blue-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Editar
                </a>
                <button wire:click="$emit('mostrarAlerta', {{ $vacante->id }})"
                    class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center">
                    Eliminar
                </button>
            </div>
        </div>
        @endforeach
        @else
        <p class="p-3 text-center text-sm text-gray-200">No Hay Vacantes Que Mostrar</p>
        @endif
    </div>

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    Livewire.on('mostrarAlerta', vacanteId => {
            Swal.fire({
                title: '¿Eliminar Vacante?',
                text: "Una Vacante Eliminada no se puede recuperar",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, ¡Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Eliminar la Vacante
                    Livewire.emit('eliminarVacante', vacanteId)

                    Swal.fire(
                    '¡Eliminada!',
                    'Tu Vacante se ha Eliminado.',
                    'success'
                    )
                }
            })
        });

        
</script>
@endpush