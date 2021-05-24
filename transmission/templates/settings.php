<?php

script('transmission', 'transmission-settings');
?>

<div id="transmission" class="section">
  <h2>Transmission</h2>
  <form id="transmission-settings-form">
    <label for="transmission-rpc-port-input">RPC Port:</label>
    <input id="transmission-rpc-port-input" type="text" value="<?php p($_['rpc-port']) ?>"></input>
    <label for="transmission-rpc-username-input">RPC Username:</label>
    <input id="transmission-rpc-username-input" type="text" value="<?php p($_['rpc-username']) ?>"></input>
    <label for="transmission-rpc-password-input">RPC Password:</label>
    <input id="transmission-rpc-password-input" type="text" value="<?php p($_['rpc-password']) ?>"></input>
  </form>
</div>
