@extends('layouts.admin')
@section('content')
    <h2>Адреса фитнес-клубов</h2>
    <div style="display: flex; justify-content: right;">
        <a href="{{ route('admin.gymAddresses.create') }}" class="btn btn-primary">Добавить адрес</a>
    </div>
    <div class="alert-message"></div>
    <br>

    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">id фитнес-клуба</th>
                    <th scope="col">Название</th>
                    <th scope="col">Индекс</th>
                    <th scope="col">Страна</th>
                    <th scope="col">Город</th>
                    <th scope="col">Улица</th>
                    <th scope="col">Дом</th>
                    <th scope="col">Строение</th>
                    <th scope="col">Этаж</th>
                    <th scope="col">Квартира</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Управление</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gymAddresses as $key => $gymAddress)
                    <tr id="row-{{ $gymAddress->id }}">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            {{ $gymAddress->gym_id }}
                        </td>
                        <td>
                            {{ $gymAddress->gym->title ?? '' }}
                        </td>
                        <td>
                            {{ $gymAddress->index }}
                        </td>
                        <td>
                            {{ $gymAddress->country }}
                        </td>
                        <td>
                            {{ $gymAddress->city }}
                        </td>
                        <td>
                            {{ $gymAddress->street }}
                        </td>
                        <td>
                            {{ $gymAddress->house_number }}
                        </td>
                        <td>
                            {{ $gymAddress->building }}
                        </td>
                        <td>
                            {{ $gymAddress->floor }}
                        </td>
                        <td>
                            {{ $gymAddress->apartment }}
                        </td>
                        <td>
                            {{ $gymAddress->created_at }}
                        </td>
                        <td>
                            <div style="">
                                <a
                                    href="{{ route('admin.gymAddresses.edit', ['gymAddress' => $gymAddress]) }}">Ред.</a>&nbsp;
                                <a href="javascript:;" class="delete" rel="{{ $gymAddress->id }}"
                                    style="color: red;">Уд.</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13">Записей не найдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $gymAddresses->links() }}
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            let elements = document.querySelectorAll(".delete");
            elements.forEach(function(e, k) {
                e.addEventListener("click", function() {
                    const id = e.getAttribute('rel');
                    send(`/admin/gymAddresses/${id}`).then((result) => {
                        const answer = JSON.parse(JSON.stringify(result));
                        let alertBlock = document.querySelector('.alert-message');
                        alertBlock.textContent = '';
                        switch (answer.status.toLowerCase()) {
                            case 'ok':
                                console.log(JSON.stringify(result));
                                const message = `Запись с #ID = ${id} успешно удалена`;
                                renderBlock(alertBlock, message, 'success', 'beforeend');
                                let removeRow = document.querySelector('#row-' + id);
                                removeRow.remove();
                                setTimeout("location.reload()", 2000);
                                break;
                            case 'error':
                                console.log(JSON.stringify(result));
                                const error = 'Возникла ошибка при удалении записи';
                                renderBlock(alertBlock, error, 'danger', 'beforeend');
                                break;
                            default:
                                console.log('Wrong Answer');
                        }
                    });
                });
            });
        });
        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            // .then(res => {
            //     if (res.ok) { console.log("HTTP request successful") }
            //     else { console.log("HTTP request unsuccessful") }
            //     return res
            // })
            // .then(res => console.log(res))
            // .then(data => console.log(data))
            // .catch(error => console.log(error))
            let result = await response.json();
            return result;
        }

        function getHtml(message, type = 'success') {
            let alertContent;
            alertContent = `<div class="alert alert-${type} alert-dismissible fade show">
                                ${message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>`;
            return alertContent;
        }

        function renderBlock(container, message, type = 'success', target = 'afterbegin') {
            container.insertAdjacentHTML(target, getHtml(message, type));
            return true;
        }
    </script>
@endpush
