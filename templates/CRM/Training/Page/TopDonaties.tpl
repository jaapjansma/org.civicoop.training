<h1>Top 10 donaties</h1>
{foreach from=$topDonaties item=donatie}
    <p>{$donatie.name}: &euro; {$donatie.amount}</p>
{/foreach}

