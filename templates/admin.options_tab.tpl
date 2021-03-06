{if $auth_sites|@count > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>Url</th>
			<th class="pageicon" width="10">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$auth_sites item='entry'}
		<tr>
			<td>{$entry.url}</td>
			<td>{$entry.delete}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{/if}
<fieldset>
	<legend>
		{$options_title}
	</legend>
	<div class="pageoverflow">
		<p class="pagetext">
			{$auth_url_title}:
		</p>
		<p class="pageinput">
			{$auth_url}
		</p>
	</div>
	<div class="pageoverflow">
		<p class="pagetext">
			{$cache_title}:
		</p>
		<p class="pageinput">
			{$cache}
		</p>
	</div>
</fieldset>
<fieldset>
	<legend>
		{$export_title}
	</legend>
	<div class="pageoverflow">
		<p class="pagetext">
			{$save_file_title}:
		</p>		
		<p class="pageinput">
			{$save_file_input}
		</p>
	</div>	
	<div class="pageoverflow">
		<p class="pagetext">
			{$dir_title}:
		</p>
		<p class="pageinput">
			{$dir_input}
		</p>
	</div>		
</fieldset>	
	<div class="pageoverflow">
		<p class="pagetext">
			&nbsp;
		</p>
		<p class="pageinput">
			{$submit_options}{$cancel}
		</p>
	</div>