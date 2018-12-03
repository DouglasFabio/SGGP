<?php
    function ModalOKCancelar($titulo, $texto, $id, $caminho, $acao){
        
        printf('
            <form action="'.$caminho.'" method="post">
                <div class="modal fade" id="'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">'.$titulo.'</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">'.$texto.'</div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" '.$acao.'>OK</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>');

    }
?>