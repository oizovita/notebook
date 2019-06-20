<?php

/* @var $this yii\web\View */


use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = 'Notebook';
?>
<!--Scrip for delete get request with url-->
<script>
    if (typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", '<?php echo $_SERVER['PHP_SELF'];?>');
    }
</script>
<div class="site-index">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 ">
                <ul id="name" class="list-group">
                    <li class="list-group-item">Name
                        <button  onclick="sortListDir('name','A','LI','LI','LI','phone','email','day')" type="button" class="btn btn-outline-primary btn-sm">
                            <img src="https://img.icons8.com/small/16/000000/alphabetical-sorting.png"></button>
                    </li>
                    <?php foreach ($contacts as $contact): ?>

                        <a class="list-group-item list-group-item-action" data-toggle="modal"
                           data-target="#<?= Html::encode("{$contact->id}") ?>"><?= Html::encode("{$contact->name} ") ?> </a>

                        <div class="modal fade" id="<?= Html::encode("{$contact->id}") ?>" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Name <?= Html::encode("{$contact->name} ") ?> </p>
                                        <img src="g../uploads/<?= $contact->id . "/" . $contact->photo ?>"
                                             alt="photo not found" width="70px" height="70px">
                                        <p>Phone <?= Html::encode("{$contact->phone} ") ?> </p>
                                        <p>Email <?= Html::encode("{$contact->email} ") ?> </p>
                                        <p>Country <?= Html::encode("{$contact->country} ") ?> </p>
                                        <p>City <?= Html::encode("{$contact->city} ") ?> </p>
                                        <p>Facebook <?= Html::encode("{$contact->facebook} ") ?> </p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </ul>

            </div>

            <div class="col-lg-3">

                <ul id="phone" class="list-group">
                    <p class="list-group-item">Phone
                        <button onclick="sortListDir('phone','LI','A','LI','LI','name','email','day')" type="button"
                                class="btn btn-outline-primary btn-sm"><img
                                    src="https://img.icons8.com/small/16/000000/numerical-sorting-21.png"">
                        </button>
                    </p>
                    <?php foreach ($contacts as $contact): ?>
                        <li class="list-group-item "><?= Html::encode("{$contact->phone} ") ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-3">
                <ul id="email" class="list-group">
                    <p class="list-group-item">Email
                        <button onclick="sortListDir('email','LI','A','LI','LI','name','phone','day')" type="button"
                                class="btn btn-outline-primary btn-sm"><img
                                    src="https://img.icons8.com/small/16/000000/alphabetical-sorting.png"></button>
                    </p>
                    <?php foreach ($contacts as $contact): ?>
                        <li class="list-group-item "><?= Html::encode("{$contact->email} ") ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-2">
                <ul id="day" class="list-group">
                    <p class="list-group-item">Birthday
                        <button onclick="sortListDir('day','LI','A','LI','LI','name','email','phone')" type="button" class="btn btn-outline-primary btn-sm">
                            <img src="https://img.icons8.com/small/16/000000/numerical-sorting-21.png"></button>
                    </p>
                    <?php foreach ($contacts as $contact): ?>
                        <li class="list-group-item "><?= Html::encode("{$contact->birthday} ") ?></li>

                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-lg-1">
                <ul id="delete" class="list-group">
                    <li style="padding: 25px; border: none" class="list-group-item"></li>
                    <?php foreach ($contacts as $contact): ?>

                        <a class="list-group-item list-group-item-action"
                           href='index.php?id=<?= Html::encode("{$contact->id}") ?>'>
                            <img src="https://img.icons8.com/metro/26/000000/delete-sign.png" height="20px">
                        </a>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <button type="button" id="btn" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong">+
        </button>
    </div>
</div>

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(['id' => 'form-contact', 'options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'birthday')->widget(DatePicker::className(), [
                    'dateFormat' => 'yyyy-MM-dd',
                ]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'photo')->fileInput() ?>
                <?= $form->field($model, 'phone')->textInput(['type' => 'number', 'maxlength' => 10]) ?>
                <?= $form->field($model, 'country')->textInput() ?>
                <?= $form->field($model, 'city')->textInput() ?>
                <?= $form->field($model, 'facebook')->textInput() ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!--Sorting list-->
<script>
    function sortListDir(id, tag, tagOneColum, tagTwoColum, tagThreeColumn, colOne, colTwo, colThree) {
        var list, i, switching, b, shouldSwitch, dir, switchcount = 0;
        list = document.getElementById(id);
        var listOneId =document.getElementById(colOne);
        var listTwoId =document.getElementById(colTwo);
        var listThreeId =document.getElementById(colThree);
        var listDelId =document.getElementById("delete");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        //Make a loop that will continue until no switching has been done:
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            b = list.getElementsByTagName(tag);
            var tagOne = listOneId.getElementsByTagName(tagOneColum);
            var tagTwo = listTwoId.getElementsByTagName(tagTwoColum);
            var tagThree = listThreeId.getElementsByTagName(tagThreeColumn);
            var tagDelete = listDelId.getElementsByTagName("A");

            //Loop through all list-items:
            for (i = 0; i < (b.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*check if the next item should switch place with the current item,
                based on the sorting direction (asc or desc):*/
                if (dir == "asc") {
                    if (b[i].innerHTML.toLowerCase() > b[i + 1].innerHTML.toLowerCase()) {
                        /*if next item is alphabetically lower than current item,
                        mark as a switch and break the loop:*/
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (b[i].innerHTML.toLowerCase() < b[i + 1].innerHTML.toLowerCase()) {
                        /*if next item is alphabetically higher than current item,
                        mark as a switch and break the loop:*/
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                and mark that a switch has been done:*/
                b[i].parentNode.insertBefore(b[i + 1], b[i]);
                tagOne[i].parentNode.insertBefore(tagOne[i + 1], tagOne[i]);
                tagTwo[i].parentNode.insertBefore(tagTwo[i + 1], tagTwo[i]);
                tagThree[i].parentNode.insertBefore(tagThree[i + 1], tagThree[i]);
                tagDelete[i].parentNode.insertBefore(tagDelete[i + 1], tagDelete[i]);
                switching = true;
                //Each time a switch is done, increase switchcount by 1:
                switchcount++;
            } else {
                /*If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again.*/
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>