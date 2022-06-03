<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 * @var \App\Model\Entity\Offer $offer
 * @var \Cake\Collection\CollectionInterface|string[] $offers
 */
?>


<?= $this->Html->css(['viewUser', 'miligram.min', 'normalize.min', 'viewProvider', 'ordersProfile']) ?>
<div class="row">
    <div class="column-responsive column-80 " >
        <div class="provider_container">
            <div class="provider_image">
                <?= $this->Html->image('userProfileImage/userProfileImage3.jpg', ['alt' => 'Owner profile image', 'class' => 'ownerimg']) ?>
            </div>
            <div class="provider_info">
                <div class="provider_name">
                    <p class="property_name"><?= __('Name:   ') ?></p>
                    <p><?= h($user->name) ."   " ?></p>
                    <p><?= h($user->surname) ?></p>
                </div>
                <div class="provider_contact">
                    <div class="provider_contact_detail">
                        <p class="property_name"><?= __('Phone Number:   ') ?></p>
                        <p><?= h($user->phone_number) ?></p>
                    </div>
                    <div class="provider_contact_detail">

                        <p class="property_name"><?= __('Email:') ?></p>
                        <p><?= h($user->email) ?></p>
                    </div>
                </div>
            </div>
            <div class="provider_edit">
                <?php if($user->id == $id_user_log):?>
                <?= $this->Html->link(__('Edytuj profil'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item button float-right']) ?>
                <?= $this->Html->link(__('Wyloguj'), ['action' => 'logout'], ['class' => 'side-nav-item button float-right']) ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="bookmarks_wrapper">


            <?php if($user->account_type_id == 2): ?>
                <div><?= $this->Html->link(__('Oferty użytkownika'), ['action' => 'profile', 1, $user->id]) ?></div>
                <div><?= $this->Html->link(__('Otrzymane oceny'), ['action' => 'profile', 2, $user->id]) ?></div>
                <?php if($user->id == $id_user_log):?>
                <div class="current_bookmarks">Zamówienia</div>
                <?php endif; ?>
            <?php endif; ?>


            <?php if($user->account_type_id==1): ?>
                <div><?= $this->Html->link(__('Oferty obserwowane'), ['action' => 'profile', 1, $user->id]) ?></div>
                <div><?= $this->Html->link(__('Dodane oceny'), ['action' => 'profile', 2, $user->id]) ?></div>
                <?php if($user->id == $id_user_log):?>
                <div class="current_bookmarks">Zamówienia</div>
            <?php endif;?>
            <?php endif; ?>
        </div>





        <div class="users view content">
            <div style="display: flex; justify-content: space-around">
            </div>
            <div class="offer_container">

                <?php if($user->account_type_id == 1): ?>

            <?php foreach ($bookings as $booking) : ?>
                        <?php if($booking->user_id == $user->id): ?>

                <tr>
                    <div class="profile-order-container">
                        <div class="profile-order-property">
                        <p class="property_name"><?= __('Data zlozenia zamowienia:   ') ?></p>
                    <td><?= h($booking->created) ?></td>
                            <p class="property_name"><?= __('Data wykonania uslugi:   ') ?></p>
                            <td><?= h($booking->booking_date) ?></td>
                            </div>
                        <div class="profile-order-property">
                            <h2><?= $booking->has('offer') ? $this->Html->link($booking->offer->name, ['controller' => 'Offers', 'action' => 'view',  $booking->offer->id]) : '' ?></h2>
                        </div>
                        <div class="profile-order-property">
                    <td class="actions">
                        <div class="profile-order-actions">
                            <?php if($booking->user_id == $id_user_log):?>

                            <?php if($booking->booking_date < date("Y-m-d")) : ?>
                        <?= $this->Form->postLink(__('Anuluj'), ['controller' => 'Bookings', 'action' => 'delete', $booking->id], ['confirm' => __('Czy na pewno chcesz anulować rezerwację?'), 'class' => 'button profile-order-btn profile-order-btn-red']) ?>
                                <?php endif; ?>
                                    <?php if($booking->booking_date >= date("Y-m-d")) : ?>
                                    <p>Zamowienie zakonczone </p>
                                    <?php endif; ?>

                        <?php endif; ?>
                                </div>
                    </td>
                        </div>
                    </div>
                </tr>
                        <?php endif; ?>
            <?php endforeach; ?>

                <?php endif; ?>







                <?php if($user->account_type_id == 2): ?>

                    <?php foreach ($bookings as $booking) : ?>

                            <?php if(!(in_array($booking->offer_id, $his_offers))): continue; ?>
                            <?php endif; ?>


                            <tr>
                                <div class="profile-order-container">
                                    <div class="profile-order-property">
                                        <p class="property_name"><?= __('Data zlozenia zamowienia:   ') ?></p>
                                        <td><?= h($booking->created) ?></td>
                                        <p class="property_name"><?= __('Data wykonania uslugi:   ') ?></p>
                                        <td><?= h($booking->booking_date) ?></td>
                                    </div>
                                    <div class="profile-order-property">
                                        <h2><?= $booking->has('user') ? $this->Html->link($booking->user->name, ['controller' => 'Offers', 'action' => 'view',  $booking->offer->id]) : '' ?></h2>
                                        <h2><?= $booking->has('offer') ? $this->Html->link($booking->offer->name, ['controller' => 'Offers', 'action' => 'view',  $booking->offer->id]) : '' ?></h2>
                                    </div>
                                    <div class="profile-order-property">
                                        <td class="actions">
                                            <div class="profile-order-actions">

                                                    <?php if($booking->booking_date < date("Y-m-d")) : ?>
                                                        <p>Zamowienie w trakcie realizacji. </p>
                                                    <?php endif; ?>
                                                    <?php if($booking->booking_date >= date("Y-m-d")) : ?>
                                                        <p>Zamowienie zakonczone </p>
                                                    <?php endif; ?>

                                            </div>
                                        </td>
                                    </div>
                                </div>
                            </tr>

                    <?php endforeach; ?>

                <?php endif; ?>


                                          <!--  <?= $this->Html->link(__('Edit'), ['controller' => 'SavedUserBookings', 'action' => 'edit', $booking->id], ['class' => 'button profile-order-btn']) ?> -->
                                           <!-- <?= $this->Form->postLink(__('Delete'), ['controller' => 'SavedUserBookings', 'action' => 'delete', $booking->id], ['confirm' => __('Czy na pewno chcesz anulować rezerwację?'), 'class' => 'button profile-order-btn profile-order-btn-red']) ?> -->




            </div>
        </div>




