<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelector('.alertnew').addEventListener('click', () => {
            location.reload();
        });
    });
</script>
<div class="alertnew">
    <div>
        <h4 class="h4close">x</h4>
    </div>
    <h5>{{\Session::get('mensaje')}}</h5>
</div>