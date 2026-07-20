-- Skema Postgres untuk SIPAS Pajaten (auto-generated)

DROP TABLE IF EXISTS "users" CASCADE;
CREATE TABLE "users" (
  "id" bigserial NOT NULL,
  "name" varchar(255) NOT NULL,
  "email" varchar(255) NOT NULL,
  "email_verified_at" timestamp(0) without time zone,
  "password" varchar(255) NOT NULL,
  "is_admin" boolean DEFAULT false NOT NULL,
  "remember_token" varchar(100),
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "password_reset_tokens" CASCADE;
CREATE TABLE "password_reset_tokens" (
  "email" varchar(255) NOT NULL,
  "token" varchar(255) NOT NULL,
  "created_at" timestamp(0) without time zone,
  PRIMARY KEY ("email")
);

DROP TABLE IF EXISTS "sessions" CASCADE;
CREATE TABLE "sessions" (
  "id" varchar(255) NOT NULL,
  "user_id" bigint,
  "ip_address" varchar(45),
  "user_agent" text,
  "payload" text NOT NULL,
  "last_activity" integer NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "cache" CASCADE;
CREATE TABLE "cache" (
  "key" varchar(255) NOT NULL,
  "value" text NOT NULL,
  "expiration" bigint NOT NULL,
  PRIMARY KEY ("key")
);

DROP TABLE IF EXISTS "cache_locks" CASCADE;
CREATE TABLE "cache_locks" (
  "key" varchar(255) NOT NULL,
  "owner" varchar(255) NOT NULL,
  "expiration" bigint NOT NULL,
  PRIMARY KEY ("key")
);

DROP TABLE IF EXISTS "jobs" CASCADE;
CREATE TABLE "jobs" (
  "id" bigserial NOT NULL,
  "queue" varchar(255) NOT NULL,
  "payload" text NOT NULL,
  "attempts" integer NOT NULL,
  "reserved_at" integer,
  "available_at" integer NOT NULL,
  "created_at" integer NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "job_batches" CASCADE;
CREATE TABLE "job_batches" (
  "id" varchar(255) NOT NULL,
  "name" varchar(255) NOT NULL,
  "total_jobs" integer NOT NULL,
  "pending_jobs" integer NOT NULL,
  "failed_jobs" integer NOT NULL,
  "failed_job_ids" text NOT NULL,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer NOT NULL,
  "finished_at" integer,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "failed_jobs" CASCADE;
CREATE TABLE "failed_jobs" (
  "id" bigserial NOT NULL,
  "uuid" varchar(255) NOT NULL,
  "connection" varchar(255) NOT NULL,
  "queue" varchar(255) NOT NULL,
  "payload" text NOT NULL,
  "exception" text NOT NULL,
  "failed_at" timestamp(0) without time zone NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "migrations" CASCADE;
CREATE TABLE "migrations" (
  "id" serial NOT NULL,
  "migration" varchar(255) NOT NULL,
  "batch" integer NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "members" CASCADE;
CREATE TABLE "members" (
  "id" bigserial NOT NULL,
  "nama" varchar(60) NOT NULL,
  "peran" varchar(80) DEFAULT 'Anggota' NOT NULL,
  "prodi" varchar(255),
  "foto" varchar(255),
  "urutan" integer DEFAULT 0 NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "education_videos" CASCADE;
CREATE TABLE "education_videos" (
  "id" bigserial NOT NULL,
  "judul" varchar(150) NOT NULL,
  "youtube_url" varchar(255) NOT NULL,
  "urutan" integer DEFAULT 0 NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "posters" CASCADE;
CREATE TABLE "posters" (
  "id" bigserial NOT NULL,
  "judul" varchar(150) NOT NULL,
  "gambar" varchar(255) NOT NULL,
  "keterangan" varchar(255),
  "urutan" integer DEFAULT 0 NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "waste_items" CASCADE;
CREATE TABLE "waste_items" (
  "id" bigserial NOT NULL,
  "nama" varchar(80) NOT NULL,
  "emoji" varchar(8) DEFAULT '?️' NOT NULL,
  "kategori" text NOT NULL,
  "sumber" varchar(20) DEFAULT 'rumah' NOT NULL,
  "saran" varchar(160) NOT NULL,
  "waktu_urai" varchar(60),
  "fakta" text,
  "urutan" integer DEFAULT 0 NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "quiz_questions" CASCADE;
CREATE TABLE "quiz_questions" (
  "id" bigserial NOT NULL,
  "pertanyaan" text NOT NULL,
  "opsi" jsonb NOT NULL,
  "jawaban" integer NOT NULL,
  "penjelasan" text,
  "aktif" boolean DEFAULT true NOT NULL,
  "urutan" integer DEFAULT 0 NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "reports" CASCADE;
CREATE TABLE "reports" (
  "id" bigserial NOT NULL,
  "lokasi" varchar(200) NOT NULL,
  "deskripsi" text,
  "status" text DEFAULT 'baru' NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "activity_notes" CASCADE;
CREATE TABLE "activity_notes" (
  "id" bigserial NOT NULL,
  "isi" text NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "umkms" CASCADE;
CREATE TABLE "umkms" (
  "id" bigserial NOT NULL,
  "emoji" varchar(8) DEFAULT '?' NOT NULL,
  "nama" varchar(80) NOT NULL,
  "deskripsi" text,
  "tag" varchar(30),
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "game_results" CASCADE;
CREATE TABLE "game_results" (
  "id" bigserial NOT NULL,
  "nama" varchar(100) NOT NULL,
  "usia" integer,
  "asal" varchar(120),
  "jenis" text NOT NULL,
  "skor" integer NOT NULL,
  "benar" integer NOT NULL,
  "total_soal" integer NOT NULL,
  "detail" jsonb,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "gallery_albums" CASCADE;
CREATE TABLE "gallery_albums" (
  "id" bigserial NOT NULL,
  "judul" varchar(180) NOT NULL,
  "tanggal" date NOT NULL,
  "cerita" text,
  "instagram_url" varchar(255),
  "urutan" integer DEFAULT 0 NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "photos" CASCADE;
CREATE TABLE "photos" (
  "id" bigserial NOT NULL,
  "album_id" bigint,
  "src" varchar(255) NOT NULL,
  "caption" varchar(160) DEFAULT 'Dokumentasi kegiatan' NOT NULL,
  "bulan" varchar(20),
  "label" varchar(60),
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "schedules" CASCADE;
CREATE TABLE "schedules" (
  "id" bigserial NOT NULL,
  "minggu" integer DEFAULT 1 NOT NULL,
  "tanggal" date,
  "jam" varchar(20),
  "periode" varchar(60),
  "judul" varchar(120) NOT NULL,
  "tempat" varchar(120),
  "deskripsi" text,
  "hasil" text,
  "foto" varchar(255),
  "foto_2" varchar(255),
  "status" text DEFAULT 'upcoming' NOT NULL,
  "ikon" varchar(8) DEFAULT '?' NOT NULL,
  "urutan" integer DEFAULT 0 NOT NULL,
  "created_at" timestamp(0) without time zone,
  "updated_at" timestamp(0) without time zone,
  PRIMARY KEY ("id")
);

ALTER TABLE "photos" ADD CONSTRAINT photos_album_id_fk FOREIGN KEY ("album_id") REFERENCES "gallery_albums"("id") ON DELETE SET NULL;
