<div class="pageoptions">
	<p class="pageoptions">
		{$add_item_icon} {$add_item_link}
	</p>
</div>
{if $items|count > 0}
<table cellspacing="0" class="pagetable">
	<thead>
		<tr>
			<th>{$item_title}</th>
			<th>{$item_type}</th>
			<th>{$item_description}</th>
			<th>{$item_url}</th>
			<th>{$item_tag}</th>
			<th class="pageicon"></th>
			<th class="pageicon"></th>
		</tr>
	</thead>
	<tbody>
		{foreach from=$items item='entry'}
		<tr class="{cycle values='row1,row2'}">
			<td>{$entry->edit_url}</td>
			<td>{$entry->getType()}</td>
			<td>{$entry->getItemDescription()|truncate:'60'}</td>
			<td>{$entry->getItemUrl()|truncate:'60'}</td>
			<td>{literal}{MultiParser item_id='{/literal}{$entry->getId()}{literal}'}{/literal}</td>
			<td>{$entry->edit}</td>
			<td>{$entry->delete}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{/if}
<div class="pageoptions">
	<p class="pageoptions">
		{$add_item_icon} {$add_item_link}
	</p>
</div>