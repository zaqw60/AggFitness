@extends('layouts.admin')
@section('content')
    <h2>Роли пользователей</h2>
    <div style="display: flex; justify-content: right;">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Создать роль</a>
    </div><br>
    <div class="alert-message"></div><br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Роль</th>
                <th scope="col">Название</th>
                <th scope="col">Описание</th>
                <th scope="col">Дата создание</th>
                <th scope="col">Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr id="row-{{ $role->id }}">
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->role }}</td>
                    <td>{{ $role->title }}</td>
                    <td>{{ $role->description }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td>
                        <div style="">
                            <a href="{{ route('admin.roles.edit', ['role' => $role]) }}">Ред.</a>&nbsp;
                            <a href="javascript:;" class="delete" rel="{{ $role->id }}"
                               style="color: red;">Уд.</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Записей не найдено</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            let elements = document.querySelectorAll(".delete");
            elements.forEach(function (e, k) {
                e.addEventListener("click", function () {
                    const id = e.getAttribute('rel');
                    send(`/admin/roles/${id}`).then((result) => {
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

