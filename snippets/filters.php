<ul class="filter">
    <?php if (!empty($options)) : ?>
        <?php foreach ($options as $field) : ?>
            <?php if (!empty($field['items'])) : ?>
                <li class="filter-group">
                    <span class="filter-group-title"><?= $field['name'] ?></span>
                    <ul class="filter-group-options">
                        <?php foreach ($field['items'] as $option) : ?>
                            <li class="filter-option">
                                <a href="<?= page()->url()?><?= esc($option['url']) ?>"
                                class="filter-option-link <?= $option['active'] ? 'active' : '' ?>">
                                <?= esc($option['value']) ?> <?= $option['active'] ? '✓' : '' ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

<style>
    .filter {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        padding: 0;
        margin: 0;
    }

    .filter-group-title {
        font-weight: 600;
    }
</style>