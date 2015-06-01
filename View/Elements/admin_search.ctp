<?php $searchValue = isset($searchValue)? $searchValue : '';?>
<?php $searchPlaceHolder = isset($searchPlaceHolder)? $searchPlaceHolder : '';?>
<form action="<?php echo $this->Html->url(array('controller'=>$this->request->controller,'action'=>$this->request->action))?>" method="GET" class="form-search pull-right">
    <div class="input-append hidden-phone">
        <input value="<?php echo $searchValue; ?>" class="m-wrap large" size="10" name="q" type="text" placeholder="<?php echo $searchPlaceHolder; ?>" >
        <button class="btn green" type="submit" class="btn green">Search</button>
    </div>
    <?php if(isset($searchValue)){ ?>
        <a class="btn " href="<?php echo $this->Html->url(array('action'=>'index'))?>">Show All</a>
    <?php } ?>
</form>
