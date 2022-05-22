<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SavedUserOffer $savedUserOffer
 * @var string[]|\Cake\Collection\CollectionInterface $users
 * @var string[]|\Cake\Collection\CollectionInterface $offers
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $savedUserOffer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $savedUserOffer->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Saved User Offers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="savedUserOffers form content">
            <?= $this->Form->create($savedUserOffer) ?>
            <fieldset>
                <legend><?= __('Edit Saved User Offer') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('offer_id', ['options' => $offers]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
