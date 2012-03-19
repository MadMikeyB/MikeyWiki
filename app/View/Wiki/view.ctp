
<?php if ($create): ?>
<h2>Creating Page: <?php echo $title_for_layout ?></h2>
<div class="clear"></div>
<?php 

echo $this->Form->create('Wiki'); 
if (empty($user)) {
echo $this->Form->input('author', array('label' => 'Your Name:', 'required'));    
}
echo $this->Form->hidden('title', array('value' => $title_for_layout)); 
echo $this->Form->textarea('entry', array('id'=>'content','class'=>'ckeditor'));
echo $this->Form->end('Submit');

?>

<?php elseif ($edit): ?>
<h2>Editting Page: <?php echo $title_for_layout ?></h2>
<div class="clear"></div>
<?php 

echo $this->Form->create('Wiki'); 
if (empty($user)) {
echo $this->Form->input('author', array('label' => 'Your Name:', 'required'));    
}
echo $this->Form->hidden('title', array('value' => $title_for_layout)); 
echo $this->Form->textarea('entry', array('id'=>'content','class'=>'ckeditor', 'value' => $wiki['Wiki']['entry']));
echo $this->Form->end('Submit');

?>
<?php else: ?>
<h2><?php echo $title_for_layout ?></h2>
<?php //echo Sanitize::clean($wiki['Wiki']['entry'], array('odd_spaces' => true, 'unicode' =>'true', 'backslash' => 'true')); ?>
<?php echo $wiki['Wiki']['entry']; ?>
<small class="right"><a href="/wiki/<?php echo $wiki['Wiki']['slug'] ?>/act:editpage">[Edit This Page]</a></small>
<?php endif; ?>