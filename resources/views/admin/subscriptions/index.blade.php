@extends('layouts.admin')
@section('content')
    <h2>
        {{ config('admin.menuList.subscriptions.description') }}
    </h2>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <x-admin.link href="{{ route('admin.subscriptions.index') . '?trashed' }}" class="btn btn-outline-primary">
            Удаленные подписчики
            <span id="recycled-user-count">
                {{ ($recycled > 0)? '(' . $recycled . ')' : '' }}
            </span>
        </x-admin.link>
    </div>
    <br>
    <div id="alert-message" class="alert-message" role="alert"></div><br>
    @include('inc.message')
    <x-admin.table id="subscription_table">
        <x-slot name="heading">
            <x-admin.table.th scope="col">#</x-admin.table.th>
            <x-admin.table.th scope="col">Телефон</x-admin.table.th>
            <x-admin.table.th scope="col">Электронная почта</x-admin.table.th>
            <x-admin.table.th scope="col">Статус</x-admin.table.th>
            <x-admin.table.th scope="col">Дата подписки</x-admin.table.th>
            <x-admin.table.th scope="col">Управление</x-admin.table.th>
        </x-slot>
        @forelse($subscriptions as $subscription)
            <x-admin.table.tr id="row-{{ $subscription->id }}">
                <x-admin.table.th scope="row"/>
                <x-admin.table.td>{{ $subscription->phone ?? ''}}</x-admin.table.td>
                <x-admin.table.td>{{ $subscription->email ?? ''}}</x-admin.table.td>
                <x-admin.table.td>{{ $subscription->status ?? ''}}</x-admin.table.td>
                <x-admin.table.td>{{ $subscription->created_at ?? ''}}</x-admin.table.td>
                <x-admin.table.td>
                    @if($subscription->trashed())
                        <div class="text-center">
                            <x-admin.link class="text-decoration-none"
                                          href="{{ route('admin.subscriptions.restore', $subscription->id) }}"
                                          title="Восстановить">
                                <x-admin.icon.restore/>
                            </x-admin.link>
                            <x-admin.link class="text-decoration-none"
                                          href="{{ route('admin.subscriptions.force_delete', $subscription->id) }}"
                                          style="color: red;" title="Очистить корзину">
                                <x-admin.icon.fulltrash/>
                            </x-admin.link>
                        </div>
                    @else
                        <div class="text-center">
                            <x-admin.link class="text-decoration-none" title="Редактировать подписку"
                                          href="{{ route('admin.subscriptions.edit', ['subscription' => $subscription]) }}">
                                <x-admin.icon.edit/>
                            </x-admin.link>
                            <x-admin.link href="javascript:;" class="delete text-decoration-none"
                                          style="color: red;" title="Удалить в корзину">
                                <x-admin.icon.trash/>
                            </x-admin.link>
                        </div>
                    @endif
                </x-admin.table.td>
            </x-admin.table.tr>
        @empty
            <span>
                  Записей не найдено
            </span>
        @endforelse
    </x-admin.table>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
            integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
            crossorigin="anonymous"></script>

    <script type="text/javascript">
        const userUrl = '{{ route('admin.subscriptions.index') }}';

        function getHtml(message, type = 'success') {
            let alertContent;
            alertContent = `<div class="alert alert-${type} alert-dismissible fade show">
                                ${message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>`;
            return alertContent;
        }

        function renderBlock(container, message, type = 'success', target = 'afterbegin') {
            delAlert('alert-dismissible');
            container.insertAdjacentHTML(target, getHtml(message, type));
            return true;
        }

        function delAlert(className = 'alert-message') {
            let $itemRemove = Array.from(document.getElementsByClassName(className));

            $itemRemove.forEach(item => item.remove());
        }

        async function send(url) {
            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });

            return await response.json();
        }

        document.addEventListener('DOMContentLoaded', function () {
            let table = new DataTable('#subscription_table', {
                processing: true,
                dom: '<"row" <"col-sm-12 col-md-5"l><"col-sm-12 col-md-7 text-end"i>>rt<"row" <"col-sm-12 col-md-5"l><"col-sm-12 col-md-7"p>><"clear">',
                searching: true,
                lengthMenu: [5, 10, 15, 20],
                iDisplayLength: {{ config('pagination.admin.subscriptions') }},
                order: [[1, 'asc']],
                responsive: true,
                language: {
                    processing: "",
                    search: "Поиск по значению поля&nbsp;:",
                    lengthMenu: "Показано _MENU_ записей",
                    info: "Показано с _START_ по  _END_  из _TOTAL_ записей.",
                    infoEmpty: "Показано с 0 по  0  из 0 записей.",
                    infoFiltered: "(всего фильтровать _MAX_ элемент(а,ов))",
                    infoPostFix: "",
                    loadingRecords: "Загрузка...",
                    zeroRecords: "Нет записей, удовлетворяющих поиску",
                    emptyTable: "Нет данных в таблице",
                    paginate: {
                        first: "Первая",
                        previous: "&nbsp;<&nbsp;",
                        next: "&nbsp;>&nbsp;",
                        last: "Последняя"
                    }
                },
                columnDefs: [
                    {
                        searchable: false,
                        orderable: false,
                        targets: 0,
                    },
                    {
                        searchable: false,
                        orderable: false,
                        targets: 5,
                    }
                ]
            });

            table.on('order.dt search.dt', function () {
                let i = 1;
                table.cells(null, 0, {search: 'applied', order: 'applied'}).every(function (cell) {
                    this.data(i++);
                });
            }).draw();

            document
                .querySelector('#tableSearchText')
                .addEventListener('keyup', function () {
                    table.search(this.value).draw();
                });

            table.on('click', 'td a.delete', function () {
                const tr = $(this).closest('tr');
                const data = table.row(tr).data();
                const id = data['DT_RowId'].split('-').slice(-1)[0];

                send(userUrl + `/${id}`).then((result) => {
                    const answer = JSON.parse(JSON.stringify(result));
                    const alertBlock = document.querySelector('.alert-message');

                    if (answer.success === true) {
                        table.row('#row-' + id).remove().draw(false);
                        renderBlock(alertBlock, answer.message, 'success', 'beforeend');
                        setTimeout(function () {
                            delAlert('alert-dismissible');
                        }, 2000);
                    } else {
                        renderBlock(alertBlock, answer.message, 'warning', 'beforeend');
                        setTimeout(function () {
                            delAlert('alert-dismissible');
                        }, 2000);
                    }
                    document.getElementById('recycled-user-count').innerHTML = '(' + answer.recycled + ')';
                });
            });
        });
    </script>
@endpush
