<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared("
        CREATE PROCEDURE create_user(IN fname VARCHAR(100), IN lname VARCHAR(100), IN mail VARCHAR(150))
        BEGIN
            INSERT INTO users (first_name, last_name, email, created_at, updated_at)
            VALUES (fname, lname, mail, NOW(), NOW());
        END
    ");

        DB::unprepared("
        CREATE PROCEDURE get_user_by_id(IN uid INT)
        BEGIN
            SELECT * FROM users WHERE id = uid;
        END
    ");

        DB::unprepared("
        CREATE PROCEDURE get_all_users()
        BEGIN
            SELECT * FROM users;
        END
    ");

        DB::unprepared("
        CREATE PROCEDURE update_user(IN uid INT, IN fname VARCHAR(100), IN lname VARCHAR(100), IN mail VARCHAR(150))
        BEGIN
            UPDATE users SET first_name = fname, last_name = lname, email = mail, updated_at = NOW() WHERE id = uid;
        END
    ");

        DB::unprepared("
        CREATE PROCEDURE delete_user(IN uid INT)
        BEGIN
            DELETE FROM users WHERE id = uid;
        END
    ");
    }

    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS create_user");
        DB::unprepared("DROP PROCEDURE IF EXISTS get_user_by_id");
        DB::unprepared("DROP PROCEDURE IF EXISTS get_all_users");
        DB::unprepared("DROP PROCEDURE IF EXISTS update_user");
        DB::unprepared("DROP PROCEDURE IF EXISTS delete_user");
    }

};
