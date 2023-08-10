<div class="modal fade" id="<?= isset($id)?$id:"generalModal" ?>" tabindex="-1" aria-labelledby="generalModal" aria-hidden="true">
  <div class="modal-dialog modal-<?= isset($size)?$size:"md" ?> <?= (isset($vertical) && $vertical)?"modal-dialog-centered":"" ?>">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?= isset($prefix)?$prefix:"gm" ?>_title"><?= isset($title)?$title:"title" ?></h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="<?= isset($prefix)?$prefix:"gm" ?>_body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
        <?= isset($add_btn)?$add_btn:"" ?>
        
      </div>
    </div>
  </div>
</div>
