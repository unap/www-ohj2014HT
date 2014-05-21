<div id="wysihtml5-toolbar" style="display: none; margin-bottom: 5px;">
  <a class="btn btn-default" data-wysihtml5-command="bold"><span class="glyphicon glyphicon-bold "></span></a>
  <a class="btn btn-default" data-wysihtml5-command="italic"><span class="glyphicon glyphicon-italic "></span></a>
  <a class="btn btn-default" data-wysihtml5-command="underline"><span class="glyphicon glyphicon-text-width "></span></a>
  
  <!-- Some wysihtml5 commands require extra parameters -->
  <a class="btn btn-default" data-wysihtml5-command="foreColor" data-wysihtml5-command-value="red">red</a>
  <a class="btn btn-default" data-wysihtml5-command="foreColor" data-wysihtml5-command-value="green">green</a>
  <a class="btn btn-default" data-wysihtml5-command="foreColor" data-wysihtml5-command-value="blue">blue</a>
  
  <!-- Some wysihtml5 commands like 'createLink' require extra paramaters specified by the user (eg. href) -->
  <a class="btn btn-default" data-wysihtml5-command="createLink"><span class="glyphicon glyphicon-link "></span></a>
  <div data-wysihtml5-dialog="createLink" style="display: none;">
    <label>
      Link:
      <input data-wysihtml5-dialog-field="href" value="http://" class="text">
    </label>
    <a class="btn btn-default" data-wysihtml5-dialog-action="save">OK</a> <a class="btn btn-default" data-wysihtml5-dialog-action="cancel">Cancel</a>
  </div>
</div>