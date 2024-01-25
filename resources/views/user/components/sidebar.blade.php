<?php
use App\Models\UserCheck;
use App\Models\AnswerCheck;
?>
<div class="dashboard__sidebar scroll-bar-1">
    <div class="sidebar -dashboard">
        <div class="sidebar__item <?php if (Request::is('user')){echo '-is-active -dark-bg-dark-2';}?>">
            <a href="/user" class="d-flex items-center text-17 lh-1 fw-500 -dark-text-white">
                <i class="text-20 fas fa-home mr-15"></i>
                Asosiy sahifa
            </a>
        </div>

        <div class="sidebar__item ">
            <a href="{{route('logout')}}" class="d-flex items-center text-17 lh-1 fw-500 ">
                <i class="text-20 icon-power mr-15"></i>
                Chiqish
            </a>
        </div>
    </div>
</div>
