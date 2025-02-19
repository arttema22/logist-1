<!-- Modal delete -->
<!-- Универсальное модальное окно для удаления любых записей. -->
<!-- В data-bs-url передается адрес ссылки для удаления. Параметр обязательный.-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $(".btn-del-modal").click(
                function () {
                    var url = $(this).attr('data-bs-url');
                    $(".modal-title").html("Удаление " + $(this).attr('data-bs-type'))
                    $(".modal-body").html("Вы действительно хотите произвести удаление " + $(this).attr('data-bs-type') + "?")
                    $(".modal-footer").html('<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>\n\
                        <a href="' + url + '" class="btn btn-primary">Удалить</a>')
                })
    });
</script>