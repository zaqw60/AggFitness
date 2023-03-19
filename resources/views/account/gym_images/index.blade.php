@extends('layouts.main')
@section('content')
    <x-account.gym.menu></x-account.gym.menu>
    <div class="container px-4 py-5" id="custom-cards">
        @if (count($gymImages) > 0)
            <h2 class="pb-2 border-bottom text-center">Редактирование фотографий фитнес-клуба</h2>
        @else
            <h2 class="pb-2 border-bottom text-center">Добавьте фотографии фитнес-клуба</h2>
        @endif
        <div class="row g-4 py-5">
            @foreach ($gymImages as $gymImage)
                <div class="col-md-auto">
                    <div class="card shadow-lg bg-dark bg-gradient" style="width: 18rem;">
                        <img src="{{ Storage::disk('public')->url($gymImage->image) }}" class="card-img-top" alt="img">
                        <div class="card-body text-center">
                            <a class="mb-2 me-1 btn btn-outline-success"
                                href="{{ route('account.gym_images.edit', ['gym_image' => $gymImage->id]) }}">
                                &#128736;
                                Заменить
                            </a>
                            @if (count($gymImages) > 1)
                                <a href="javascript:;" class="mb-2 me-1 btn btn-outline-danger delete"
                                    rel="{{ $gymImage->id }}">
                                    &#128465;
                                    Удалить
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $gymImages->links() }}
    </div>
    <hr class="featurette-divider">
@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            let elements = document.querySelectorAll(".delete");
            elements.forEach(function(e, k) {
                e.addEventListener("click", function() {
                    const id = e.getAttribute('rel');
                    if (confirm(`Подтверждаете удаление изображения?`)) {
                        //send id on the server
                        send(`/account/gym_images/${id}`).then(() => {
                            location.reload();
                        })
                    } else {
                        alert("Удаление отменено")
                    }
                })
            })
        })
        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
