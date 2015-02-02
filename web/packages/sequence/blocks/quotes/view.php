<div quote-cycle="7">
    <?php foreach($dataFields AS $index => $pair): ?>
        <div class="group">
            <q><?php echo $this->controller->_translateFrom($pair->body); ?></q>
            <cite><?php echo $pair->author; ?></cite>
        </div>
    <?php endforeach; ?>
</div>