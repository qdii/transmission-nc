<?php

script('transmission', 'transmission-settings');
?>

<div id="transmission" class="section">
  <h2>Transmission</h2>
  <form id="transmission-settings-form">
    <label for="transmission-rpc-port-input">RPC Port:</label>
    <input id="transmission-rpc-port-input" type="text" value="<?php p($_['rpc-port']) ?>"></input>
  </form>
</div>
