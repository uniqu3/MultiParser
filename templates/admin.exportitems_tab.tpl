<div class="pageoptions">
	<p class="pageoptions">
		{$add_exportitem_icon} {$add_exportitem_link}
	</p>
</div>
{if $exportitems|count > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$exportitem_title}</th>
			<th>{$exportitem_type}</th>
			<th>{$exportitem_description}</th>
			<th class="pageicon"></th>
			<th class="pageicon"></th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$exportitems item='entry'}
		<tr class="{cycle values='row1,row2'}">
			<td>{$entry->edit_url}</td>
			<td>{$entry->GetType()}</td>
			<td>{$entry->GetItemDescription()}</td>
			<td>{$entry->edit}</td>
			<td>{$entry->delete}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{/if}
<div class="pageoptions">
	<p class="pageoptions">
		{$add_exportitem_icon} {$add_exportitem_link}
	</p>
</div>