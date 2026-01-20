<h2 style="margin-top:0">Login</h2>
<p>Default admin: <code>admin@meditrust.local</code> / <code>admin123</code></p>
<form id="loginForm" method="post" action="<?php echo BASE_URL; ?>/login" style="max-width:420px">
  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(csrf_token()); ?>">
  <div style="margin-bottom:12px">
    <label>Email</label><br/>
    <input id="email" name="email" type="email" required style="width:100%;padding:10px;border-radius:10px;border:1px solid #ccc"/>
  </div>
  <div style="margin-bottom:12px">
    <label>Password</label><br/>
    <input id="password" name="password" type="password" required style="width:100%;padding:10px;border-radius:10px;border:1px solid #ccc"/>
  </div>
  <button id="loginBtn" type="submit" style="padding:10px 14px;border-radius:10px;border:none;background:#111827;color:#fff;cursor:pointer">Login</button>
</form>
