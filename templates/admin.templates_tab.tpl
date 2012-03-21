<div class="pageoptions">
	<p class="pageoptions">
		{$addtemplateicon} {$addtemplatelink}
	</p>
</div>
{if $templates|count > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$title_template}</th><th class="pageicon"> </th><th class="pageicon"> </th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$templates item=entry}
		<tr class="{cycle values='row1,row2'}">
			<td>{$entry->edit_url}</td><td>{$entry->editlink}</td><td>{$entry->deletelink}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
<div class="pageoptions">
	<p class="pageoptions">
		{$addtemplateicon} {$addtemplatelink}
	</p>
</div>
{/if}