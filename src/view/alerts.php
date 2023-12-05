<?php
// Quick documentation:
/*
- $alerts should be an array of array:
Each earray inside $alerts should be composed this way: ['type', 'message']
With type being:
- success for green
- danger for red
- warning for yellow
- info for blue
*/

foreach ($alerts as $alert) {?>
    <div class="alert alert-<?=$alert[0]?> alert-dismissible fade show">
        <?=$alert[1]?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php
}