<div class="menu">
<?php foreach ($packages as $package):?>
    <div class="a flex">
        <div>
            <i class="icon-box c-yellow"></i><?php echo $package['name']; ?><br />
            <span style="font-size:10px">
                <i class="icon-level-down c-blue"></i>версия:
                <span class="c-green">
                    v<?php echo $package['version']; ?>
                </span>
            </span>
        </div>
        <a href="/apanel/package/<?php echo $package['dir']; ?>" title="">Настройки</a>
    </div>
<?php endforeach; ?>
</div>
