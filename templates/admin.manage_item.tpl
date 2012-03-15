<h3>{$title_section}</h3>
{$form_start}
<fieldset>
<legend>Edit Item</legend>
<div class="pageoverflow">
	<p class="pagetext">
		{$title_item_title}:
	</p>
	<p class="pageinput">
		{$input_item_title}
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">
		{$item_types}
	</p>
	<p class="pageinput">
		{$input_item_type}
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">
		{$title_item_url}:
	</p>
	<p class="pageinput">
		{$input_item_url}
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">
		{$title_item_description}:
	</p>
	<p class="pageinput">
		{$input_item_description}
	</p>
</div>
<div class="pageoverflow">
	<p class="pagetext">
		&nbsp;
	</p>
	<p class="pageinput">
		{$submit_button}{$apply_button}{$cancel}
	</p>
</div>
</fieldset>
{$form_end}