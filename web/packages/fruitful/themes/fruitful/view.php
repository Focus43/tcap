<?php  defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('inc/header.php'); ?>

    <div id="headerShell">
        
        <?php  
            $a = new Area('Header'); 
            $a->enableGridContainer();
            $a->display($c);    
        ?>
        
    </div>
    
    <main id="mainShell">       
            
        <article>
        
            <?php  if($error){?>
            <div class="container">
                <div class="twelvecol sixcol-medium pushthree-medium">
                    <?php  Loader::element('system_errors', array('error' => $error)); ?>
                </div>
            </div>
            <?php  } ?>
            <?php  print $innerContent; ?>                
        
        </article>
                
    </main><!-- #mainShell -->
    
<?php  $this->inc('inc/footer.php'); ?> 