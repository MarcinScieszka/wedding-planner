<div class="sidebar">
    <a class="category">Sala</a>

    <?php if ($account_type_id == 2) : ?>
        <div class="side-nav">
            <?= $this->Html->link(__('Dodaj nową ofertę'), ['controller' => 'Offers', 'action' => 'add', h($category->id)]) ?>
        </div>
    <?php endif; ?>

    <label id="label_sorting_type" for="select_sorting_type">Sortowanie</label>
    <select name="sorting_types" id="select_sorting_type">
        <option value="by_popularity">Domyślnie</option>
        <option value="by_popularity">Od najpopularniejszych</option>
        <option value="by_lowest_price">Od najtańszych</option>
        <option value="by_highest_price">Od najdroższych</option>
    </select>
    <div class="filters">
        <h3>Filtry</h3>
<!--        <div class="filter_accommodations_count">-->
<!--            <h4>Miejsc noclegowych</h4>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="accommodations_count" id="accommodations_count_50">-->
<!--                <label for="accommodations_count_50">do 50</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="accommodations_count" id="accommodations_count_100">-->
<!--                <label for="accommodations_count_100">do 100</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="accommodations_count" id="accommodations_count_200">-->
<!--                <label for="accommodations_count_200">do 200</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="accommodations_count" id="accommodations_count_300">-->
<!--                <label for="accommodations_count_300">do 300</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="accommodations_count" id="accommodations_count_500">-->
<!--                <label for="accommodations_count_500">do 500</label>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="filter_people_count">-->
<!--            <h4>Liczba osób</h4>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="people_count" id="people_count_50" value="people_count_50">-->
<!--                <label for="people_count_50">do 50</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="people_count" id="people_count_100" value="people_count_100">-->
<!--                <label for="people_count_100">do 100</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="people_count" id="people_count_200" value="people_count_200">-->
<!--                <label for="people_count_200">do 200</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="people_count" id="people_count_300" value="people_count_300">-->
<!--                <label for="people_count_300">do 300</label>-->
<!--            </div>-->
<!--            <div class="checkbox-pair">-->
<!--                <input type="radio" name="people_count" id="people_count_500" value="people_count_500">-->
<!--                <label for="people_count_500">do 500</label>-->
<!--            </div>-->
<!--        </div>-->
        <div class="filter_extras">
            <h4>Opcje</h4>
            <div class="checkbox-pair">
                <input type="checkbox" name="extras" id="extras_air_conditioning" value="extras_air_conditioning" class="filter">
                <label for="extras_air_conditioning">klimatyzacja</label>
            </div>
            <div class="checkbox-pair">
                <input type="checkbox" name="extras" id="extras_garden" value="extras_garden" class="filter">
                <label for="extras_garden">ogród</label>
            </div>
            <div class="checkbox-pair">
                <input type="checkbox" name="extras" id="extras_terrace" value="extras_terrace" class="filter">
                <label for="extras_terrace">taras</label>
            </div>
            <div class="checkbox-pair">
                <input type="checkbox" name="extras" id="extras_bar" value="extras_bar" class="filter">
                <label for="extras_bar">bar</label>
            </div>
            <div class="checkbox-pair">
                <input type="checkbox" name="extras" id="extras_stage" value="extras_stage" class="filter">
                <label for="extras_stage">scena</label>
            </div>
        </div>
        <div class="filter_business_type">
            <h4>Rodzaj lokalu</h4>
            <div class="checkbox-pair">
                <input type="checkbox" name="business_type" id="business_type_restaurant" value="business_type_restaurant" class="filter">
                <label for="business_type_restaurant">Restauracja</label>
            </div>
            <div class="checkbox-pair">
                <input type="checkbox" name="business_type" id="business_type_wedding_hall" value="business_type_wedding_hall" class="filter">
                <label for="business_type_wedding_hall">Sala weselna</label>
            </div>
            <div class="checkbox-pair">
                <input type="checkbox" name="business_type" id="business_type_wedding_house" value="business_type_wedding_house" class="filter">
                <label for="business_type_wedding_house">Dom weselny</label>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        function showOffer(category, elem) {
            var showOffer = false;
            if ($('#' + category).is(':checked')) {
                var attr = elem.attr(category);
                if (typeof attr !== 'undefined' && attr !== false) {
                    showOffer = true;
                }
            }

            var searchInfo = $('#input_search_description').val();
            if (showOffer) {
                if (searchInfo == '') {
                    elem.show();
                } else {
                    if (elem.attr('info').toLowerCase().indexOf(searchInfo.toLowerCase()) >= 0) {
                        elem.show();
                    }
                }
            }
        }

        $('#input_search_description').change(function(){
            var isCategoryChecked = false;
            $('.filter').each(function(index, element) {
                if($(this).is(':checked')) {
                    isCategoryChecked = true;
                }
            })

            if(isCategoryChecked) {
                search();
            } else {
                searchInfo();
            }
        })

        function searchInfo() {
            $('.offer').each(function (index, element) {
                $(this).hide();
            });

            var searchInfo = $('#input_search_description').val();
            $('.offer').each(function(index, element) {
                if( $(this).attr('info').toLowerCase().indexOf( searchInfo.toLowerCase() ) >= 0 ) {
                    $(this).show();
                }
            });
        }

        function search() {
            $('.offer').each(function (index, element) {
                $(this).hide();
            });

            $('.offer').each(function(index, element) {
                showOffer('extras_air_conditioning', $(this));
                showOffer('extras_garden', $(this));
                showOffer('extras_terrace', $(this));
                showOffer('extras_bar', $(this));
                showOffer('extras_stage', $(this));

                showOffer('business_type_restaurant', $(this));
                showOffer('business_type_wedding_hall', $(this));
                showOffer('business_type_wedding_house', $(this));
            });

            var showAll = true;
            $('.filter').each(function(index, element) {
                if($(this).is(':checked')) {
                    showAll = false;
                }
            })
            if(showAll) {
                $('.offer').each(function (index, element) {
                    $(this).show();
                });
                $('#input_search_description').trigger('change');
            }
        }

        $('.filter').click(function(e){
            search();
        })
    })
</script>

