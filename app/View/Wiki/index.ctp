
<div class="right" id="latest_edits_block" style="width:20%;">
<h3>Latest Edits</h3>
<ul>
<?php foreach ($latestedits as $latest): ?>
<li><a href="/wiki/<?php echo $latest['Wiki']['slug'] ?>"><?php echo $latest['Wiki']['title'] ?></a></li>
<?php endforeach; ?>
</ul>
</div>

<div class="left" style="float: left; width:70%;">
<h2><?php echo $featuredwiki['Wiki']['title']; ?></h2>
<hr style="padding-bottom:0px;margin-bottom:0px;" />
<?php echo $featuredwiki['Wiki']['entry']; ?>
<small class="right"><a href="/wiki/<?php echo $featuredwiki['Wiki']['slug'] ?>/act:editpage">[Edit This Page]</a></small>

</div>