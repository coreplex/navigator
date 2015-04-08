<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php foreach ($menu as $item): ?>
                    <li <?php if ($item->isActive()): ?>class="active"<?php endif; ?>>
                        <?php if ( ! isset($item->items)): ?>
                            <a <?php if (isset($item->url)): ?>href="<?php echo $item->url; ?>"<?php endif; ?>><?php echo $item->title ?></a>
                        <?php else: ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $item->title ?> <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <?php if ( ! empty($item->items)): ?>
                                        <?php foreach ($item->items as $item): ?>
                                            <li <?php if ($item->isActive()): ?>class="active"<?php endif; ?>>
                                                <a <?php if (isset($item->url)): ?>href="<?php echo $item->url; ?>"<?php endif; ?>><?php echo $item->title ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>