<?php
class UserModel extends Model
{
    public function findByEmail(string $email): ?array
    {
        $st = $this->db->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
        $st->execute(['email'=>$email]);
        return $st->fetch() ?: null;
    }

    public function createDefaultAdminIfNone(): void
    {
        $count = $this->db->query("SELECT COUNT(*) AS c FROM users")->fetch();
        if (($count['c'] ?? 0) > 0) return;

        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $st = $this->db->prepare("INSERT INTO users (name, role, email, password_hash) VALUES ('Admin','admin','admin@meditrust.local',:h)");
        $st->execute(['h'=>$hash]);
    }
}
