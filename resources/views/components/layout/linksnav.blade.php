<div class="flex {{$btnclass}}">
    <button id="navbarBtn">
        <img class="toggle block" src="https://img.icons8.com/material-outlined/24/000000/menu--v1.png" width="30" height="30">
        <img class="toggle hidden" src="https://img.icons8.com/ios/50/000000/delete-sign--v1.png" width="20" height="20">
    </button>
</div>
<div class="toggle {{$navclass}} hidden">
    {{$slot}}
</div>
