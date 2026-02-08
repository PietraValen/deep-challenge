<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Skip for SQLite (testing environment)
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        // 1. Create View: v_client_summary
        DB::statement("
            CREATE VIEW v_client_summary AS
            SELECT 
                c.id, 
                c.name, 
                COUNT(p.id) as total_processes, 
                (SELECT COUNT(*) FROM deadlines d WHERE d.process_id IN (SELECT id FROM processes WHERE client_id = c.id) AND d.status = 'Pendente') as pending_deadlines
            FROM clients c
            LEFT JOIN processes p ON c.id = p.client_id
            GROUP BY c.id, c.name
        ");

        // 2. Create Stored Procedure: sp_get_dashboard_stats
        DB::unprepared("
            CREATE PROCEDURE sp_get_dashboard_stats(IN user_id_param BIGINT)
            BEGIN
                SELECT 
                    (SELECT COUNT(*) FROM clients WHERE user_id = user_id_param) as total_clients,
                    (SELECT COUNT(*) FROM processes WHERE user_id = user_id_param AND status = 'Em Andamento') as active_processes,
                    (SELECT COUNT(*) FROM deadlines WHERE user_id = user_id_param AND status = 'Pendente') as pending_deadlines;
            END
        ");

        // 3. Create Trigger: tr_touch_process_on_deadline
        // Note: Triggers in SQLite are different from MySQL. Assuming MySQL since 'procedure' was requested.
        // If SQLite, syntax would be slightly different. Providing MySQL syntax as per user implication.
        DB::unprepared("
            CREATE TRIGGER tr_touch_process_update AFTER UPDATE ON deadlines
            FOR EACH ROW
            BEGIN
                IF NEW.process_id IS NOT NULL THEN
                    UPDATE processes SET updated_at = NOW() WHERE id = NEW.process_id;
                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER tr_touch_process_insert AFTER INSERT ON deadlines
            FOR EACH ROW
            BEGIN
                IF NEW.process_id IS NOT NULL THEN
                    UPDATE processes SET updated_at = NOW() WHERE id = NEW.process_id;
                END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return;
        }

        DB::unprepared("DROP TRIGGER IF EXISTS tr_touch_process_update");
        DB::unprepared("DROP TRIGGER IF EXISTS tr_touch_process_insert");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_get_dashboard_stats");
        DB::statement("DROP VIEW IF EXISTS v_client_summary");
    }
};
