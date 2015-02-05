<style type="text/css">
    #singlePageNav ul li {padding:0.5rem 0;}
</style>

<div id="singlePageNav">
    <div class="row">
        <div class="col-sm-12">
            <p>This block scans your page for sections you can link to for auto-scrolling. <strong>Note:</strong> If you change the number of sections on the page or move content around, you might have to update this to stay accurate.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12" available-sections>
            <ul class="list-unstyled">
                <!-- javascripted -->
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        _singlePageNavHandler({
            container   : document.querySelector('[available-sections] > ul'),
            existing    : <?php echo !empty($existingAsJson) ? $existingAsJson : '[]'; ?>
        });
    });
</script>