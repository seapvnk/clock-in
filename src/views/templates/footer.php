<footer class="footer">

    <span>Desenvolvido com </span>
    <span class="text-primary"><i class="fas fa-heart mx-1"></i></span>
    <span> por <a href="https://github.com/seapvnk" target="_blank" rel="noopener noreferrer">Pedro Sérgio</a></span>

</footer>

<script src="assets/js/core/jquery.min.js" ></script>
<script src="assets/js/core/popper.min.js" ></script>
<script src="assets/js/core/bootstrap.min.js" ></script>
<script src="assets/js/plugins/bootstrap-switch.js" ></script>

<script>

// switch
$('.bootstrap-switch').each(function(){
    $this = $(this);
    data_on_label = $this.data('on-label') || '';
    data_off_label = $this.data('off-label') || '';

    $this.bootstrapSwitch({
        onText: data_on_label,
        offText: data_off_label
    });
});
</script>

<script src="assets/js/app.js" ></script>
