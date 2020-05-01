<div id="transmission-settings" class="section">
    <h2>Transmission</h2>
    <div id="transmission-settings-content">
        <p>
            Transmission server to connect to:
        </p>
        <form id="transmission-server" action="/index.php/apps/transmission/save" method="post">
            <p>
                <label for="transmission-server-ip-label">IP address</label>
                <input type="text" name="" id="transmission-server-ip" placeholder="127.0.0.1" value="<?php $_['host']?>">
                <label for="transmission-server-port">Port</label>
                <input type="text" name="" id="transmission-server-port" placeholder="9091" value="<?php $_['port']?>">
                <input type="submit" name="transmission-server-save" id="transmission-server-save-input" value="Save">
            </p>
        </form>
    </div>
</div>
