--
-- PostgreSQL database dump
--

\restrict l1yKO2BAsbJ29JP3F76siQbsgLUsgoo2PaQQzexUFVTzD7ubpt3jG4dJDMhFI3b

-- Dumped from database version 15.17
-- Dumped by pg_dump version 15.17

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY public.tickets DROP CONSTRAINT tickets_user_id_foreign;
ALTER TABLE ONLY public.ticket_messages DROP CONSTRAINT ticket_messages_user_id_foreign;
ALTER TABLE ONLY public.ticket_messages DROP CONSTRAINT ticket_messages_ticket_id_foreign;
ALTER TABLE ONLY public.ticket_messages DROP CONSTRAINT ticket_messages_admin_id_foreign;
ALTER TABLE ONLY public.subscriptions DROP CONSTRAINT subscriptions_user_id_foreign;
ALTER TABLE ONLY public.saas_reviews DROP CONSTRAINT saas_reviews_user_id_foreign;
ALTER TABLE ONLY public.saas_products DROP CONSTRAINT saas_products_user_id_foreign;
ALTER TABLE ONLY public.product_features DROP CONSTRAINT product_features_product_id_foreign;
ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_user_id_foreign;
ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_order_id_foreign;
ALTER TABLE ONLY public.invoices DROP CONSTRAINT invoices_user_id_foreign;
ALTER TABLE ONLY public.helpdesk_users DROP CONSTRAINT helpdesk_users_user_id_foreign;
ALTER TABLE ONLY public.chatbot_leads DROP CONSTRAINT chatbot_leads_user_id_foreign;
ALTER TABLE ONLY public.chatbot_leads DROP CONSTRAINT chatbot_leads_admin_id_foreign;
ALTER TABLE ONLY public.chat_messages DROP CONSTRAINT chat_messages_chat_session_id_foreign;
ALTER TABLE ONLY public.carts DROP CONSTRAINT carts_user_id_foreign;
DROP INDEX public.visitor_logs_session_id_index;
DROP INDEX public.visitor_logs_date_index;
DROP INDEX public.sessions_user_id_index;
DROP INDEX public.sessions_last_activity_index;
DROP INDEX public.notifications_notifiable_type_notifiable_id_index;
DROP INDEX public.jobs_queue_index;
DROP INDEX public.chatbot_responses_keyword_index;
DROP INDEX public.chat_sessions_user_id_index;
ALTER TABLE ONLY public.visitor_logs DROP CONSTRAINT visitor_logs_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_username_unique;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_godaddy_shopper_id_unique;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
ALTER TABLE ONLY public.tickets DROP CONSTRAINT tickets_pkey;
ALTER TABLE ONLY public.ticket_messages DROP CONSTRAINT ticket_messages_pkey;
ALTER TABLE ONLY public.subscriptions DROP CONSTRAINT subscriptions_pkey;
ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
ALTER TABLE ONLY public.saas_reviews DROP CONSTRAINT saas_reviews_pkey;
ALTER TABLE ONLY public.saas_products DROP CONSTRAINT saas_products_slug_unique;
ALTER TABLE ONLY public.saas_products DROP CONSTRAINT saas_products_pkey;
ALTER TABLE ONLY public.products DROP CONSTRAINT products_slug_unique;
ALTER TABLE ONLY public.products DROP CONSTRAINT products_pkey;
ALTER TABLE ONLY public.product_features DROP CONSTRAINT product_features_pkey;
ALTER TABLE ONLY public.portfolios DROP CONSTRAINT portfolios_slug_unique;
ALTER TABLE ONLY public.portfolios DROP CONSTRAINT portfolios_pkey;
ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_pkey;
ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_invoice_number_unique;
ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_pkey;
ALTER TABLE ONLY public.notifications DROP CONSTRAINT notifications_pkey;
ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
ALTER TABLE ONLY public.jobs DROP CONSTRAINT jobs_pkey;
ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
ALTER TABLE ONLY public.invoices DROP CONSTRAINT invoices_pkey;
ALTER TABLE ONLY public.invoices DROP CONSTRAINT invoices_invoice_no_unique;
ALTER TABLE ONLY public.hero_settings DROP CONSTRAINT hero_settings_pkey;
ALTER TABLE ONLY public.helpdesk_users DROP CONSTRAINT helpdesk_users_pkey;
ALTER TABLE ONLY public.helpdesk_users DROP CONSTRAINT helpdesk_users_license_key_email_unique;
ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
ALTER TABLE ONLY public.email_accounts DROP CONSTRAINT email_accounts_pkey;
ALTER TABLE ONLY public.email_accounts DROP CONSTRAINT email_accounts_email_unique;
ALTER TABLE ONLY public.chatbot_responses DROP CONSTRAINT chatbot_responses_pkey;
ALTER TABLE ONLY public.chatbot_leads DROP CONSTRAINT chatbot_leads_pkey;
ALTER TABLE ONLY public.chatbot_knowledges DROP CONSTRAINT chatbot_knowledges_pkey;
ALTER TABLE ONLY public.chat_sessions DROP CONSTRAINT chat_sessions_session_id_unique;
ALTER TABLE ONLY public.chat_sessions DROP CONSTRAINT chat_sessions_pkey;
ALTER TABLE ONLY public.chat_messages DROP CONSTRAINT chat_messages_pkey;
ALTER TABLE ONLY public.carts DROP CONSTRAINT carts_pkey;
ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
ALTER TABLE ONLY public.admins DROP CONSTRAINT admins_username_unique;
ALTER TABLE ONLY public.admins DROP CONSTRAINT admins_pkey;
ALTER TABLE public.visitor_logs ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.tickets ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.ticket_messages ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.subscriptions ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.saas_reviews ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.saas_products ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.products ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.product_features ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.portfolios ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.orders ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.order_items ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.jobs ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.invoices ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.hero_settings ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.helpdesk_users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.email_accounts ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.chatbot_responses ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.chatbot_leads ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.chatbot_knowledges ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.chat_sessions ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.chat_messages ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.carts ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.admins ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE public.visitor_logs_id_seq;
DROP TABLE public.visitor_logs;
DROP SEQUENCE public.users_id_seq;
DROP TABLE public.users;
DROP SEQUENCE public.tickets_id_seq;
DROP TABLE public.tickets;
DROP SEQUENCE public.ticket_messages_id_seq;
DROP TABLE public.ticket_messages;
DROP SEQUENCE public.subscriptions_id_seq;
DROP TABLE public.subscriptions;
DROP TABLE public.sessions;
DROP SEQUENCE public.saas_reviews_id_seq;
DROP TABLE public.saas_reviews;
DROP SEQUENCE public.saas_products_id_seq;
DROP TABLE public.saas_products;
DROP SEQUENCE public.products_id_seq;
DROP TABLE public.products;
DROP SEQUENCE public.product_features_id_seq;
DROP TABLE public.product_features;
DROP SEQUENCE public.portfolios_id_seq;
DROP TABLE public.portfolios;
DROP TABLE public.password_reset_tokens;
DROP SEQUENCE public.orders_id_seq;
DROP TABLE public.orders;
DROP SEQUENCE public.order_items_id_seq;
DROP TABLE public.order_items;
DROP TABLE public.notifications;
DROP SEQUENCE public.migrations_id_seq;
DROP TABLE public.migrations;
DROP SEQUENCE public.jobs_id_seq;
DROP TABLE public.jobs;
DROP TABLE public.job_batches;
DROP SEQUENCE public.invoices_id_seq;
DROP TABLE public.invoices;
DROP SEQUENCE public.hero_settings_id_seq;
DROP TABLE public.hero_settings;
DROP SEQUENCE public.helpdesk_users_id_seq;
DROP TABLE public.helpdesk_users;
DROP SEQUENCE public.failed_jobs_id_seq;
DROP TABLE public.failed_jobs;
DROP SEQUENCE public.email_accounts_id_seq;
DROP TABLE public.email_accounts;
DROP SEQUENCE public.chatbot_responses_id_seq;
DROP TABLE public.chatbot_responses;
DROP SEQUENCE public.chatbot_leads_id_seq;
DROP TABLE public.chatbot_leads;
DROP SEQUENCE public.chatbot_knowledges_id_seq;
DROP TABLE public.chatbot_knowledges;
DROP SEQUENCE public.chat_sessions_id_seq;
DROP TABLE public.chat_sessions;
DROP SEQUENCE public.chat_messages_id_seq;
DROP TABLE public.chat_messages;
DROP SEQUENCE public.carts_id_seq;
DROP TABLE public.carts;
DROP TABLE public.cache_locks;
DROP TABLE public.cache;
DROP SEQUENCE public.admins_id_seq;
DROP TABLE public.admins;
SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: admins; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.admins (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    role character varying(255) DEFAULT 'super_admin'::character varying NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.admins OWNER TO postgres;

--
-- Name: admins_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.admins_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.admins_id_seq OWNER TO postgres;

--
-- Name: admins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.admins_id_seq OWNED BY public.admins.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: carts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.carts (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    type character varying(255) NOT NULL,
    product_name character varying(255) NOT NULL,
    price numeric(15,2) NOT NULL,
    billing_cycle character varying(255) DEFAULT '1 Tahun'::character varying NOT NULL,
    configuration json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.carts OWNER TO postgres;

--
-- Name: carts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.carts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.carts_id_seq OWNER TO postgres;

--
-- Name: carts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.carts_id_seq OWNED BY public.carts.id;


--
-- Name: chat_messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chat_messages (
    id bigint NOT NULL,
    chat_session_id bigint NOT NULL,
    message text NOT NULL,
    sender character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT chat_messages_sender_check CHECK (((sender)::text = ANY (ARRAY[('user'::character varying)::text, ('bot'::character varying)::text])))
);


ALTER TABLE public.chat_messages OWNER TO postgres;

--
-- Name: chat_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.chat_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.chat_messages_id_seq OWNER TO postgres;

--
-- Name: chat_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.chat_messages_id_seq OWNED BY public.chat_messages.id;


--
-- Name: chat_sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chat_sessions (
    id bigint NOT NULL,
    session_id character varying(255) NOT NULL,
    user_name character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    user_id bigint
);


ALTER TABLE public.chat_sessions OWNER TO postgres;

--
-- Name: chat_sessions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.chat_sessions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.chat_sessions_id_seq OWNER TO postgres;

--
-- Name: chat_sessions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.chat_sessions_id_seq OWNED BY public.chat_sessions.id;


--
-- Name: chatbot_knowledges; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chatbot_knowledges (
    id bigint NOT NULL,
    topic character varying(255) NOT NULL,
    intent_name character varying(255) NOT NULL,
    keywords json NOT NULL,
    response text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.chatbot_knowledges OWNER TO postgres;

--
-- Name: chatbot_knowledges_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.chatbot_knowledges_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.chatbot_knowledges_id_seq OWNER TO postgres;

--
-- Name: chatbot_knowledges_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.chatbot_knowledges_id_seq OWNED BY public.chatbot_knowledges.id;


--
-- Name: chatbot_leads; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chatbot_leads (
    id bigint NOT NULL,
    user_id bigint,
    ip_address character varying(255),
    topic_context character varying(255),
    contact_info character varying(255),
    chat_history json,
    last_message text,
    status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    live_chat_status character varying(255) DEFAULT 'none'::character varying NOT NULL,
    admin_id bigint,
    CONSTRAINT chatbot_leads_live_chat_status_check CHECK (((live_chat_status)::text = ANY ((ARRAY['none'::character varying, 'pending'::character varying, 'active'::character varying, 'ended'::character varying])::text[]))),
    CONSTRAINT chatbot_leads_status_check CHECK (((status)::text = ANY ((ARRAY['pending'::character varying, 'contacted'::character varying])::text[])))
);


ALTER TABLE public.chatbot_leads OWNER TO postgres;

--
-- Name: chatbot_leads_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.chatbot_leads_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.chatbot_leads_id_seq OWNER TO postgres;

--
-- Name: chatbot_leads_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.chatbot_leads_id_seq OWNED BY public.chatbot_leads.id;


--
-- Name: chatbot_responses; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chatbot_responses (
    id bigint NOT NULL,
    keyword character varying(255) NOT NULL,
    answer text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.chatbot_responses OWNER TO postgres;

--
-- Name: chatbot_responses_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.chatbot_responses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.chatbot_responses_id_seq OWNER TO postgres;

--
-- Name: chatbot_responses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.chatbot_responses_id_seq OWNED BY public.chatbot_responses.id;


--
-- Name: email_accounts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.email_accounts (
    id bigint NOT NULL,
    email character varying(255) NOT NULL,
    email_password text NOT NULL,
    imap_host character varying(255) DEFAULT 'mail.futurecloud.id'::character varying,
    imap_port integer DEFAULT 993,
    imap_encryption character varying(255) DEFAULT 'ssl'::character varying,
    imap_protocol character varying(255) DEFAULT 'imap'::character varying,
    imap_validate_cert boolean DEFAULT false NOT NULL,
    smtp_host character varying(255) DEFAULT 'mail.futurecloud.id'::character varying,
    smtp_port integer DEFAULT 465,
    smtp_encryption character varying(255) DEFAULT 'ssl'::character varying,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.email_accounts OWNER TO postgres;

--
-- Name: email_accounts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.email_accounts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.email_accounts_id_seq OWNER TO postgres;

--
-- Name: email_accounts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.email_accounts_id_seq OWNED BY public.email_accounts.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: helpdesk_users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.helpdesk_users (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    license_key character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    avatar character varying(255),
    is_active boolean DEFAULT true NOT NULL,
    last_login_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.helpdesk_users OWNER TO postgres;

--
-- Name: helpdesk_users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.helpdesk_users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.helpdesk_users_id_seq OWNER TO postgres;

--
-- Name: helpdesk_users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.helpdesk_users_id_seq OWNED BY public.helpdesk_users.id;


--
-- Name: hero_settings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.hero_settings (
    id bigint NOT NULL,
    tagline character varying(255),
    title character varying(255),
    subtitle text,
    background_images json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    promo_image character varying(255),
    promo_url character varying(255),
    is_promo_active boolean DEFAULT false NOT NULL
);


ALTER TABLE public.hero_settings OWNER TO postgres;

--
-- Name: hero_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.hero_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.hero_settings_id_seq OWNER TO postgres;

--
-- Name: hero_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.hero_settings_id_seq OWNED BY public.hero_settings.id;


--
-- Name: invoices; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.invoices (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    invoice_no character varying(255) NOT NULL,
    description character varying(255) NOT NULL,
    amount numeric(15,2) NOT NULL,
    status character varying(255) DEFAULT 'Unpaid'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT invoices_status_check CHECK (((status)::text = ANY (ARRAY[('Paid'::character varying)::text, ('Unpaid'::character varying)::text, ('Cancelled'::character varying)::text])))
);


ALTER TABLE public.invoices OWNER TO postgres;

--
-- Name: invoices_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.invoices_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.invoices_id_seq OWNER TO postgres;

--
-- Name: invoices_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.invoices_id_seq OWNED BY public.invoices.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: notifications; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notifications (
    id uuid NOT NULL,
    type character varying(255) NOT NULL,
    notifiable_type character varying(255) NOT NULL,
    notifiable_id bigint NOT NULL,
    data text NOT NULL,
    read_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.notifications OWNER TO postgres;

--
-- Name: order_items; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.order_items (
    id bigint NOT NULL,
    order_id bigint NOT NULL,
    product_name character varying(255) NOT NULL,
    type character varying(255) NOT NULL,
    price numeric(15,2) NOT NULL,
    billing_cycle character varying(255) NOT NULL,
    configuration json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.order_items OWNER TO postgres;

--
-- Name: order_items_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.order_items_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.order_items_id_seq OWNER TO postgres;

--
-- Name: order_items_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.order_items_id_seq OWNED BY public.order_items.id;


--
-- Name: orders; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.orders (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    invoice_number character varying(255) NOT NULL,
    total_amount numeric(15,2) NOT NULL,
    payment_method character varying(255) NOT NULL,
    status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    paid_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    payment_proof character varying(255)
);


ALTER TABLE public.orders OWNER TO postgres;

--
-- Name: orders_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.orders_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.orders_id_seq OWNER TO postgres;

--
-- Name: orders_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.orders_id_seq OWNED BY public.orders.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: portfolios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.portfolios (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    category character varying(255) NOT NULL,
    client character varying(255),
    url character varying(255),
    description text NOT NULL,
    image character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.portfolios OWNER TO postgres;

--
-- Name: portfolios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.portfolios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.portfolios_id_seq OWNER TO postgres;

--
-- Name: portfolios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.portfolios_id_seq OWNED BY public.portfolios.id;


--
-- Name: product_features; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.product_features (
    id bigint NOT NULL,
    product_id bigint NOT NULL,
    feature_text character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.product_features OWNER TO postgres;

--
-- Name: product_features_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.product_features_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_features_id_seq OWNER TO postgres;

--
-- Name: product_features_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.product_features_id_seq OWNED BY public.product_features.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    type character varying(255) NOT NULL,
    price numeric(15,2) NOT NULL,
    cycle character varying(255) DEFAULT 'mo'::character varying NOT NULL,
    tag character varying(255),
    is_featured boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    discount_price numeric(15,2),
    renew_price numeric(15,2),
    transfer_price numeric(15,2),
    category character varying(255) DEFAULT 'General'::character varying NOT NULL,
    discount_config json
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: saas_products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.saas_products (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    category character varying(255) NOT NULL,
    tagline character varying(255),
    description text NOT NULL,
    price numeric(15,2) NOT NULL,
    thumbnail character varying(255),
    status character varying(255) DEFAULT 'pending'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    features json NOT NULL,
    plans json NOT NULL,
    CONSTRAINT saas_products_status_check CHECK (((status)::text = ANY (ARRAY[('pending'::character varying)::text, ('approved'::character varying)::text, ('rejected'::character varying)::text])))
);


ALTER TABLE public.saas_products OWNER TO postgres;

--
-- Name: saas_products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.saas_products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.saas_products_id_seq OWNER TO postgres;

--
-- Name: saas_products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.saas_products_id_seq OWNED BY public.saas_products.id;


--
-- Name: saas_reviews; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.saas_reviews (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    saas_slug character varying(255) NOT NULL,
    rating integer NOT NULL,
    comment text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.saas_reviews OWNER TO postgres;

--
-- Name: saas_reviews_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.saas_reviews_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.saas_reviews_id_seq OWNER TO postgres;

--
-- Name: saas_reviews_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.saas_reviews_id_seq OWNED BY public.saas_reviews.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: subscriptions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.subscriptions (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    type character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    price numeric(15,2) NOT NULL,
    reg_date date NOT NULL,
    due_date date NOT NULL,
    ip_address character varying(255) DEFAULT '-'::character varying,
    status character varying(255) DEFAULT 'Active'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.subscriptions OWNER TO postgres;

--
-- Name: subscriptions_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.subscriptions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.subscriptions_id_seq OWNER TO postgres;

--
-- Name: subscriptions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.subscriptions_id_seq OWNED BY public.subscriptions.id;


--
-- Name: ticket_messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.ticket_messages (
    id bigint NOT NULL,
    ticket_id bigint NOT NULL,
    user_id bigint,
    admin_id bigint,
    message text NOT NULL,
    attachment character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.ticket_messages OWNER TO postgres;

--
-- Name: ticket_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.ticket_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ticket_messages_id_seq OWNER TO postgres;

--
-- Name: ticket_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.ticket_messages_id_seq OWNED BY public.ticket_messages.id;


--
-- Name: tickets; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tickets (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    subject character varying(255) NOT NULL,
    status character varying(255) DEFAULT 'open'::character varying NOT NULL,
    priority character varying(255) DEFAULT 'medium'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT tickets_priority_check CHECK (((priority)::text = ANY ((ARRAY['low'::character varying, 'medium'::character varying, 'high'::character varying])::text[]))),
    CONSTRAINT tickets_status_check CHECK (((status)::text = ANY ((ARRAY['open'::character varying, 'answered'::character varying, 'closed'::character varying])::text[])))
);


ALTER TABLE public.tickets OWNER TO postgres;

--
-- Name: tickets_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tickets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tickets_id_seq OWNER TO postgres;

--
-- Name: tickets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tickets_id_seq OWNED BY public.tickets.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255),
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    google_id character varying(255),
    avatar text,
    godaddy_shopper_id character varying(255),
    phone character varying(255),
    address character varying(255),
    city character varying(255),
    province character varying(255),
    postal_code character varying(255),
    country_code character varying(255) DEFAULT 'ID'::character varying NOT NULL,
    username character varying(255),
    first_name character varying(255) NOT NULL,
    last_name character varying(255),
    role character varying(255) DEFAULT 'user'::character varying NOT NULL,
    company_name character varying(255),
    phone_number character varying(255),
    partner_status character varying(255),
    is_banned boolean DEFAULT false NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: visitor_logs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visitor_logs (
    id bigint NOT NULL,
    session_id character varying(255) NOT NULL,
    ip_address character varying(255) NOT NULL,
    date date NOT NULL,
    page_journey json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.visitor_logs OWNER TO postgres;

--
-- Name: visitor_logs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visitor_logs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visitor_logs_id_seq OWNER TO postgres;

--
-- Name: visitor_logs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visitor_logs_id_seq OWNED BY public.visitor_logs.id;


--
-- Name: admins id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admins ALTER COLUMN id SET DEFAULT nextval('public.admins_id_seq'::regclass);


--
-- Name: carts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carts ALTER COLUMN id SET DEFAULT nextval('public.carts_id_seq'::regclass);


--
-- Name: chat_messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat_messages ALTER COLUMN id SET DEFAULT nextval('public.chat_messages_id_seq'::regclass);


--
-- Name: chat_sessions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat_sessions ALTER COLUMN id SET DEFAULT nextval('public.chat_sessions_id_seq'::regclass);


--
-- Name: chatbot_knowledges id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_knowledges ALTER COLUMN id SET DEFAULT nextval('public.chatbot_knowledges_id_seq'::regclass);


--
-- Name: chatbot_leads id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_leads ALTER COLUMN id SET DEFAULT nextval('public.chatbot_leads_id_seq'::regclass);


--
-- Name: chatbot_responses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_responses ALTER COLUMN id SET DEFAULT nextval('public.chatbot_responses_id_seq'::regclass);


--
-- Name: email_accounts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.email_accounts ALTER COLUMN id SET DEFAULT nextval('public.email_accounts_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: helpdesk_users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.helpdesk_users ALTER COLUMN id SET DEFAULT nextval('public.helpdesk_users_id_seq'::regclass);


--
-- Name: hero_settings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.hero_settings ALTER COLUMN id SET DEFAULT nextval('public.hero_settings_id_seq'::regclass);


--
-- Name: invoices id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.invoices ALTER COLUMN id SET DEFAULT nextval('public.invoices_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: order_items id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.order_items ALTER COLUMN id SET DEFAULT nextval('public.order_items_id_seq'::regclass);


--
-- Name: orders id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders ALTER COLUMN id SET DEFAULT nextval('public.orders_id_seq'::regclass);


--
-- Name: portfolios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.portfolios ALTER COLUMN id SET DEFAULT nextval('public.portfolios_id_seq'::regclass);


--
-- Name: product_features id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_features ALTER COLUMN id SET DEFAULT nextval('public.product_features_id_seq'::regclass);


--
-- Name: products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: saas_products id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saas_products ALTER COLUMN id SET DEFAULT nextval('public.saas_products_id_seq'::regclass);


--
-- Name: saas_reviews id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saas_reviews ALTER COLUMN id SET DEFAULT nextval('public.saas_reviews_id_seq'::regclass);


--
-- Name: subscriptions id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subscriptions ALTER COLUMN id SET DEFAULT nextval('public.subscriptions_id_seq'::regclass);


--
-- Name: ticket_messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ticket_messages ALTER COLUMN id SET DEFAULT nextval('public.ticket_messages_id_seq'::regclass);


--
-- Name: tickets id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tickets ALTER COLUMN id SET DEFAULT nextval('public.tickets_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: visitor_logs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visitor_logs ALTER COLUMN id SET DEFAULT nextval('public.visitor_logs_id_seq'::regclass);


--
-- Data for Name: admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admins (id, name, username, password, role, remember_token, created_at, updated_at) FROM stdin;
1	Super Admin	admin	$2y$12$4o10sZYbH3mRijuz/gO0ve7wo1zTaBrbIZfjOC3FrhvBhnxNDRqS.	admin	\N	2025-12-04 15:30:49	2025-12-04 15:30:49
2	Super Admin	superadmin	$2y$12$wEJgrYiotJpEy2JwxSGx0u5E3XcfVaAujTBiyyJC8Uft96HETzYSm	super_admin	\N	2026-03-13 12:57:39	2026-03-13 12:57:39
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: carts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.carts (id, user_id, type, product_name, price, billing_cycle, configuration, created_at, updated_at) FROM stdin;
4	16	domain	makinasurei.net	186500.00	1 Year(s)	"{\\"years\\":\\"1\\",\\"action\\":\\"register\\"}"	2026-02-06 00:43:14	2026-02-06 00:43:14
66	1	domain	ghrysh.com	364000.00	1 Year(s)	"{\\"years\\":\\"1\\",\\"action\\":\\"register\\"}"	2026-08-14 22:18:35	2026-08-14 22:18:35
27	6	saas	Chatbot Plugin	250000.00	annually	"{\\"domain_connection\\":null}"	2026-07-11 05:26:02	2026-07-11 05:26:02
\.


--
-- Data for Name: chat_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chat_messages (id, chat_session_id, message, sender, created_at, updated_at) FROM stdin;
1	1	bagaimana cara sign in	user	2025-12-08 09:08:20	2025-12-08 09:08:20
2	1	Maaf, saya tidak mengerti. Silakan hubungi support kami.	bot	2025-12-08 09:08:20	2025-12-08 09:08:20
3	2	bagaimana cara sign in	user	2025-12-08 09:11:15	2025-12-08 09:11:15
4	2	Maaf, saya tidak mengerti. Silakan hubungi support kami.	bot	2025-12-08 09:11:15	2025-12-08 09:11:15
5	2	sign in	user	2025-12-08 09:11:21	2025-12-08 09:11:21
6	2	Maaf, saya tidak mengerti. Silakan hubungi support kami.	bot	2025-12-08 09:11:21	2025-12-08 09:11:21
7	2	halo	user	2025-12-08 09:11:38	2025-12-08 09:11:38
8	2	Maaf, saya tidak mengerti. Silakan hubungi support kami.	bot	2025-12-08 09:11:38	2025-12-08 09:11:38
9	2	hi	user	2025-12-08 09:11:43	2025-12-08 09:11:43
10	2	Maaf, saya tidak mengerti. Silakan hubungi support kami.	bot	2025-12-08 09:11:43	2025-12-08 09:11:43
11	2	Hallo	user	2025-12-08 09:11:47	2025-12-08 09:11:47
12	2	Maaf, saya tidak mengerti. Silakan hubungi support kami.	bot	2025-12-08 09:11:47	2025-12-08 09:11:47
13	20	hhi	user	2025-12-09 05:18:51	2025-12-09 05:18:51
14	20	Halo <b>Guest</b>! ?? Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 05:18:51	2025-12-09 05:18:51
15	20	hi	user	2025-12-09 05:20:15	2025-12-09 05:20:15
16	20	Halo <b>Guest</b>! ?? Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 05:20:15	2025-12-09 05:20:15
17	20	saya ingin login. bagaimana caranya	user	2025-12-09 05:20:34	2025-12-09 05:20:34
18	20	Silakan <a href="/login" class="font-bold text-blue-600">Klik Disini untuk Login</a>. Jika lupa password, gunakan fitur "Forgot Password" di halaman login ya.	bot	2025-12-09 05:20:34	2025-12-09 05:20:34
19	20	okey terimakasih	user	2025-12-09 05:20:51	2025-12-09 05:20:51
20	20	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 05:20:51	2025-12-09 05:20:51
21	21	halo	user	2025-12-09 05:34:10	2025-12-09 05:34:10
22	21	Halo <b>Ghryshvi Dzickra</b>! ?? Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 05:34:10	2025-12-09 05:34:10
23	21	bagaimana cara menjadi partner	user	2025-12-09 05:34:25	2025-12-09 05:34:25
24	21	Ingin dapat penghasilan tambahan? ??<br>Bergabunglah menjadi Partner FutureCloud! Anda bisa menjual aplikasi SaaS buatan Anda di marketplace kami. <br><a href="/partner/register" class="bg-blue-600 text-white px-3 py-1 rounded text-xs mt-2 inline-block">Daftar Jadi Partner</a>	bot	2025-12-09 05:34:25	2025-12-09 05:34:25
25	21	terimakasih	user	2025-12-09 05:34:56	2025-12-09 05:34:56
26	21	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 05:34:56	2025-12-09 05:34:56
27	21	saya sudah login sekarang, dan sudah sign in juga, sekarang saya ingin menjadi partner, bagaimana caranya	user	2025-12-09 05:35:36	2025-12-09 05:35:36
28	21	Ingin dapat penghasilan tambahan? ??<br>Bergabunglah menjadi Partner FutureCloud! Anda bisa menjual aplikasi SaaS buatan Anda di marketplace kami. <br><a href="/partner/register" class="bg-blue-600 text-white px-3 py-1 rounded text-xs mt-2 inline-block">Daftar Jadi Partner</a>	bot	2025-12-09 05:35:36	2025-12-09 05:35:36
29	21	halo	user	2025-12-09 05:41:57	2025-12-09 05:41:57
30	21	Halo <b>Ghryshvi Dzickra</b>! ?? Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 05:41:57	2025-12-09 05:41:57
31	21	sasa	user	2025-12-09 05:52:05	2025-12-09 05:52:05
32	21	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 05:52:05	2025-12-09 05:52:05
33	21	ahgsajsdgajsdasjd	user	2025-12-09 05:52:20	2025-12-09 05:52:20
34	21	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 05:52:20	2025-12-09 05:52:20
35	21	berapa harga domain	user	2025-12-09 05:57:27	2025-12-09 05:57:27
36	21	Amankan nama brand Anda sekarang! ??<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.	bot	2025-12-09 05:57:27	2025-12-09 05:57:27
37	21	terimakasih	user	2025-12-09 05:57:38	2025-12-09 05:57:38
38	21	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 05:57:38	2025-12-09 05:57:38
39	21	oke	user	2025-12-09 05:57:44	2025-12-09 05:57:44
40	21	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 05:57:44	2025-12-09 05:57:44
41	21	bagaimana cara login	user	2025-12-09 05:57:54	2025-12-09 05:57:54
42	21	Silakan <a href="/login" class="font-bold text-blue-600">Klik Disini untuk Login</a>. Jika lupa password, gunakan fitur "Forgot Password" di halaman login ya.	bot	2025-12-09 05:57:54	2025-12-09 05:57:54
43	21	hi	user	2025-12-09 06:19:55	2025-12-09 06:19:55
44	21	Halo <b>Ghryshvi Dzickra</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 06:19:55	2025-12-09 06:19:55
45	31	hi	user	2025-12-09 06:58:09	2025-12-09 06:58:09
46	31	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 06:58:09	2025-12-09 06:58:09
47	32	hi	user	2025-12-09 08:46:15	2025-12-09 08:46:15
48	32	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 08:46:15	2025-12-09 08:46:15
49	32	halo	user	2025-12-09 08:46:23	2025-12-09 08:46:23
50	32	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 08:46:23	2025-12-09 08:46:23
51	32	login	user	2025-12-09 08:46:34	2025-12-09 08:46:34
52	32	Silakan <a href="/login" class="font-bold text-blue-600">Klik Disini untuk Login</a>. Jika lupa password, gunakan fitur "Forgot Password" di halaman login ya.	bot	2025-12-09 08:46:34	2025-12-09 08:46:34
53	32	partner	user	2025-12-09 08:46:41	2025-12-09 08:46:41
54	32	Ingin dapat penghasilan tambahan? ??<br>Bergabunglah menjadi Partner FutureCloud! Anda bisa menjual aplikasi SaaS buatan Anda di marketplace kami. <br><a href="/partner/register" class="bg-blue-600 text-white px-3 py-1 rounded text-xs mt-2 inline-block">Daftar Jadi Partner</a>	bot	2025-12-09 08:46:41	2025-12-09 08:46:41
55	32	oke	user	2025-12-09 08:46:49	2025-12-09 08:46:49
56	32	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 08:46:49	2025-12-09 08:46:49
57	33	hi	user	2025-12-09 11:17:32	2025-12-09 11:17:32
58	33	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 11:17:32	2025-12-09 11:17:32
59	33	bagaimana cara login	user	2025-12-09 11:17:40	2025-12-09 11:17:40
60	33	Silakan <a href="/login" class="font-bold text-blue-600">Klik Disini untuk Login</a>. Jika lupa password, gunakan fitur "Forgot Password" di halaman login ya.	bot	2025-12-09 11:17:40	2025-12-09 11:17:40
61	33	sya ingin membeli domain	user	2025-12-09 11:17:51	2025-12-09 11:17:51
62	33	Amankan nama brand Anda sekarang! ??<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.	bot	2025-12-09 11:17:51	2025-12-09 11:17:51
63	34	hi	user	2025-12-09 11:20:20	2025-12-09 11:20:20
64	34	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 11:20:20	2025-12-09 11:20:20
65	34	bagaimana cara membeli domain	user	2025-12-09 11:20:30	2025-12-09 11:20:30
66	34	Amankan nama brand Anda sekarang! ??<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.	bot	2025-12-09 11:20:30	2025-12-09 11:20:30
67	35	hi	user	2025-12-09 11:45:39	2025-12-09 11:45:39
68	35	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 11:45:39	2025-12-09 11:45:39
69	35	halo	user	2025-12-09 11:45:46	2025-12-09 11:45:46
70	35	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 11:45:46	2025-12-09 11:45:46
71	35	saya ingin membeli domain	user	2025-12-09 11:46:00	2025-12-09 11:46:00
72	35	Amankan nama brand Anda sekarang! ??<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.	bot	2025-12-09 11:46:00	2025-12-09 11:46:00
73	35	okee	user	2025-12-09 11:46:14	2025-12-09 11:46:14
74	35	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-09 11:46:14	2025-12-09 11:46:14
75	35	cara jadi partner	user	2025-12-09 11:46:25	2025-12-09 11:46:25
76	35	Ingin dapat penghasilan tambahan? ??<br>Bergabunglah menjadi Partner FutureCloud! Anda bisa menjual aplikasi SaaS buatan Anda di marketplace kami. <br><a href="/partner/register" class="bg-blue-600 text-white px-3 py-1 rounded text-xs mt-2 inline-block">Daftar Jadi Partner</a>	bot	2025-12-09 11:46:25	2025-12-09 11:46:25
77	35	halo halo galo	user	2025-12-09 11:48:05	2025-12-09 11:48:05
78	35	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 11:48:05	2025-12-09 11:48:05
79	37	hi	user	2025-12-09 16:05:12	2025-12-09 16:05:12
80	37	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 16:05:12	2025-12-09 16:05:12
81	39	Halo	user	2025-12-09 23:33:35	2025-12-09 23:33:35
82	39	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-09 23:33:35	2025-12-09 23:33:35
83	39	Domain	user	2025-12-09 23:33:44	2025-12-09 23:33:44
84	39	Amankan nama brand Anda sekarang! ??<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.	bot	2025-12-09 23:33:44	2025-12-09 23:33:44
85	52	halo	user	2025-12-12 12:17:00	2025-12-12 12:17:00
86	52	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-12 12:17:00	2025-12-12 12:17:00
87	138	hi	user	2025-12-16 01:58:41	2025-12-16 01:58:41
88	138	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-16 01:58:41	2025-12-16 01:58:41
89	180	hi	user	2025-12-17 03:07:42	2025-12-17 03:07:42
90	180	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2025-12-17 03:07:42	2025-12-17 03:07:42
91	221	Y	user	2025-12-18 07:53:42	2025-12-18 07:53:42
92	221	Maaf, saya kurang paham maksudnya. ??<br>Bisa coba gunakan kata kunci lain seperti <b>'Harga Domain'</b>, <b>'Cara jadi Partner'</b>, atau <b>'Masuk Client Area'</b>?	bot	2025-12-18 07:53:42	2025-12-18 07:53:42
93	638	halo	user	2026-03-13 11:57:46	2026-03-13 11:57:46
94	638	Halo <b>Guest</b>! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	bot	2026-03-13 11:57:46	2026-03-13 11:57:46
\.


--
-- Data for Name: chat_sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chat_sessions (id, session_id, user_name, created_at, updated_at, user_id) FROM stdin;
1	1oSW385VtBr8RWNSLYooehx5E4GWpbdiXtOhIpDm	Guest	2025-12-08 09:08:20	2025-12-08 09:08:20	\N
2	6NlvqiORjfnCH38psoOKdboJELJ7SlrMzTSYbA5X	Guest	2025-12-08 09:11:15	2025-12-08 09:11:15	\N
20	W9vvJmAEnOjO5CgFlHxfVk6DWKnqp2oeZNYBO5v1	Guest	2025-12-09 05:18:51	2025-12-09 05:18:51	\N
21	UB4RZzZ3nzXInHWoDHqPWQBRFnyFZUH44u6slCfX	Ghryshvi Dzickra	2025-12-09 05:34:10	2025-12-09 05:34:10	\N
169	qnNg5APwq3FPPqQGpiBBJFLmxN2U9U6vSbw0wCbk	Admin FKUB Jakpus	2025-12-16 12:35:10	2025-12-16 12:35:10	\N
173	H8DWOQA9dH3zjvQsOBZ70TzSVoxXcjDwrPGUsRim	Ghryshvi Dzickra	2025-12-16 12:41:24	2025-12-16 12:41:24	\N
179	dnHT4hXRvzUSJS1M0g7cm7WmNg07a2qoah8hXnlS	Guest	2025-12-16 22:31:55	2025-12-16 22:31:55	\N
31	WwCErPwB36CXzt6qSMSlIt9M6m5IyEe13Eayi8YD	Guest	2025-12-09 06:58:05	2025-12-09 06:58:05	\N
32	1Fs5FEbTdTnpt2I6CmN8wLz4lyYqmzNtwq3HPfYI	Guest	2025-12-09 08:46:10	2025-12-09 08:46:10	\N
33	kD8Ao2GnRP9MiCZcx4AWd3XPSGVVjn0IBNdCskxk	Guest	2025-12-09 10:11:02	2025-12-09 10:11:02	\N
34	WUvc6aYwexw24wK9MRkWg3TXEhyxLQr6Gr7cRhK6	Guest	2025-12-09 11:18:54	2025-12-09 11:18:54	\N
35	wITeZOE3DwHEvJKTeyYlABCBKXAp7mYOlrBOTvqP	Guest	2025-12-09 11:45:21	2025-12-09 11:45:21	\N
36	20KrqKspq4mx2vPJWZYeGRz99ex5oBSPeyNg2SGX	Guest	2025-12-09 12:06:42	2025-12-09 12:06:42	\N
37	1jLkIlU49Da97qgEuFmB3zlt6pXqRRhzj1xbuvST	Guest	2025-12-09 16:04:58	2025-12-09 16:04:58	\N
38	p7k3AnY6Gs1Qx0oaekYgchd9BPnJKq6hf8m41lCm	Guest	2025-12-09 16:09:00	2025-12-09 16:09:00	\N
39	bTPQ8M61iCTUaBUABAU3srVpoDNkf9MjmqLjenMO	Guest	2025-12-09 23:33:29	2025-12-09 23:33:29	\N
40	qP1j6m8Ar4aRr1bFHkGscWWYZZ2SzH79EcQVI0Ch	Guest	2025-12-10 02:03:39	2025-12-10 02:03:39	\N
41	muJoZKyUXQ3XV3Jpj0kRbKspouUZnl7MDCCWpcRi	Guest	2025-12-10 11:42:19	2025-12-10 11:42:19	\N
42	J0UGr7OKV1ydcXCGLKayI6fntMlQOErlFvI9NdaP	Guest	2025-12-11 03:16:18	2025-12-11 03:16:18	\N
43	tDg0V7A00Bx776pe12JpasHIBH32vcQPqZhT5Nxy	Guest	2025-12-11 04:11:17	2025-12-11 04:11:17	\N
44	YA4IgGOzOeQId9c7szhjURau0jKx7jjMP0R8jJW8	Guest	2025-12-11 15:39:29	2025-12-11 15:39:29	\N
45	sGGbOkGtWYv74xqiBvrqbR89dUksObu8BFGDexbd	Guest	2025-12-11 16:29:16	2025-12-11 16:29:16	\N
46	gmguLVLYubfb0QVl7NNcDsKZ73EDQ616VMNqTCrG	Guest	2025-12-11 23:52:43	2025-12-11 23:52:43	\N
47	HwNtFlSPvZ0ovkbP5bkZzWqFtMDNgSZCmuKy4Qhn	Guest	2025-12-11 23:52:45	2025-12-11 23:52:45	\N
48	UWi3tZRUBWcirb5wg0C5yz5Ilzu8k97VNyquFtZx	Guest	2025-12-12 03:17:26	2025-12-12 03:17:26	\N
49	LbzI0nwehO2bt5r3Ywmh7x54nkENjxYZuglYxKlY	Guest	2025-12-12 08:38:28	2025-12-12 08:38:28	\N
50	Nrhd1yQdg4lrm39n46Cj8wDpIBLNdFZV04bXEzKa	Guest	2025-12-12 08:55:34	2025-12-12 08:55:34	\N
51	ilX2z5o8kK8WTcZgOvDBpPWG76BXmIjq4VXJHghV	Guest	2025-12-12 12:15:24	2025-12-12 12:15:24	\N
52	Ab2Ip3xBZm3xgA9wPbKMFyCPlE91QcHcfP0zlKbN	Guest	2025-12-12 12:16:11	2025-12-12 12:16:11	\N
53	9OeDJCzBrgTG70RrHcPjyWhJYAqIAfajk6ZGxqMt	Guest	2025-12-12 14:00:07	2025-12-12 14:00:07	\N
54	PoBDjHDn9VKCGpx0EHrIkxFzFWMFQCvUNAVZmbGt	Guest	2025-12-12 19:26:25	2025-12-12 19:26:25	\N
55	rcuaLJFsgR29xGN1JSvEL0vhriLBiwvWZooFjLqs	Guest	2025-12-12 19:32:35	2025-12-12 19:32:35	\N
56	pWANPjViOY33NUkMZB5S8TGdxnY6NThRRPjdCz11	Guest	2025-12-12 21:33:29	2025-12-12 21:33:29	\N
57	B4c2hJkMbq07hJh5SUIIl8o4kXzExXloLltx3Hex	Guest	2025-12-12 23:47:31	2025-12-12 23:47:31	\N
58	pGl1eelW1yzM15Bj6X7dFovF1gx9fSm6Rowr4i91	Guest	2025-12-13 03:35:24	2025-12-13 03:35:24	\N
59	P113shcjTSoSmIPmiGbXqnzmAnuDwoyDqnpWzl0I	PT BTT	2025-12-13 03:36:08	2025-12-13 03:36:08	\N
181	7nqO2He6Pb1Ecg26L8ZZonrfTYALNPMtCwbLDAfm	Guest	2025-12-17 02:49:16	2025-12-17 02:49:16	\N
183	oEJVPO2xvs4LeNetcpBbsOk38DIBEQjWRlj0jpcf	Guest	2025-12-17 09:31:04	2025-12-17 09:31:04	\N
185	kpx4MJU4o3MrWcuEAV74UDV9ldXsnl0sn7Gl1zgS	Guest	2025-12-17 10:08:20	2025-12-17 10:08:20	\N
63	wVHLst7JftxAMrAgJu9JAkMWAvIFotfSQKgsUJJD	Guest	2025-12-13 04:39:28	2025-12-13 04:39:28	\N
64	gVLy7lANtbeWmvVgqL9gW7KYBlObBBb8hX6nzgXa	Guest	2025-12-13 06:58:39	2025-12-13 06:58:39	\N
65	46GfLkqCT9psNXa4IMzmkApGPMWj5OwrtAgbuzb5	Guest	2025-12-13 08:24:51	2025-12-13 08:24:51	\N
66	TOoAUoDWvh1rzms3unHP8hb1ep9ptfbple0k7yUJ	Guest	2025-12-13 08:31:11	2025-12-13 08:31:11	\N
67	oRYwClAt4enpsZ0F9DxeJGCIFJ7Y8lIYQgKNSjif	Guest	2025-12-13 09:16:17	2025-12-13 09:16:17	\N
68	vkqlACqVVLPOjXL3PbeVixjSC0UxVF346Ni6FXyf	Guest	2025-12-13 09:45:50	2025-12-13 09:45:50	\N
69	RCgTtym1cfk2USBGNh1gDnsXtjTNaCaBfVrY8V2H	Guest	2025-12-13 10:47:26	2025-12-13 10:47:26	\N
70	n8g0kP6hUjqzlsMbcjPj2dr4uSHztANSGRlwRgTi	Ghryshvi Dzickra	2025-12-13 10:48:24	2025-12-13 10:48:24	\N
187	kyuVrC0Jz934vNoryMONv7ITZeqJjNzSPhPaOWPc	Guest	2025-12-17 13:04:28	2025-12-17 13:04:28	\N
82	diQumnzVuohRbvDkHlvj4AKP2kb0UTrNxLGVA1uL	Guest	2025-12-13 11:04:43	2025-12-13 11:04:43	\N
83	PdhmDR6gDtw15z7UkC4qMbWRaFKNnWDE4vJrTpys	Guest	2025-12-13 11:09:00	2025-12-13 11:09:00	\N
84	Jg8Na6OHN3SxmFCyrOa3wmMoU6L2jfPil4AN9dDP	Guest	2025-12-13 11:36:33	2025-12-13 11:36:33	\N
85	s2nCoB7McjEhm7enoswsoDvW1IPYDl6Gd62lha1g	Admin Sixperience	2025-12-13 12:36:37	2025-12-13 12:36:37	\N
86	0qw0AO85VkHEujFKEe9FM5SJ1HiTME7xxZs2KOQU	Guest	2025-12-13 13:01:45	2025-12-13 13:01:45	\N
87	wbEZrSYsy18GR2qtttN9uv2akIOe9troZIheSybT	Admin DNY Filter	2025-12-13 14:39:48	2025-12-13 14:39:48	\N
88	NrW3OH2bGkAs9fnWzhCzvgz4vGkKRK6D3vN7C6oq	Guest	2025-12-13 14:45:42	2025-12-13 14:45:42	\N
89	Jgj7HhbbxiQyroieroCqEun4BC44efuZ9AMrvYtV	Admin Sixperience	2025-12-13 14:46:02	2025-12-13 14:46:02	\N
90	MSgzHdjJjd4QBABh3OwU1Y7x0OJ7NdTd2E1pn6T5	Guest	2025-12-13 16:34:09	2025-12-13 16:34:09	\N
91	pmBeAyHYSgstqr44erqDNmEBur6Wyc0mhVXplVeq	Admin Sixperience	2025-12-13 17:49:04	2025-12-13 17:49:04	\N
166	32dE8iaz4tPf96xpT8raBf1g4X3PSNzJwElFCyFc	Guest	2025-12-16 12:22:00	2025-12-16 12:22:00	\N
97	F8KOjDkGciLGUsNEQ1yLc4cFFVIoEhcBPfCnY8Dn	Guest	2025-12-13 18:05:26	2025-12-13 18:05:26	\N
98	ZKua43b6Nh5CJwRbakUuxMdyzk20IuU1OAyQ0i7N	Guest	2025-12-14 01:51:35	2025-12-14 01:51:35	\N
99	yczr3YiXvG2Hxzk14zgVIUGLDEn0gO31x5VoCzoG	Guest	2025-12-14 02:14:20	2025-12-14 02:14:20	\N
100	8YEURzPwXGMLF7vhcSFgqTEaxQrMTttrVOs6DqJw	Admin Sixperience	2025-12-14 02:15:05	2025-12-14 02:15:05	\N
168	vPly35zymqYyHpcB5D1mS66SCOzjnNh9ZKpzv9ds	Guest	2025-12-16 12:34:59	2025-12-16 12:34:59	\N
104	8OGiXi4ySSNvdT1yXbYxykGEgMmXPxroIRXqT6gz	Guest	2025-12-14 06:18:07	2025-12-14 06:18:07	\N
105	myvGscw6yhRUfA9b8UBiLmGTcDYL3bVPfTQ0SwEY	Guest	2025-12-14 06:18:29	2025-12-14 06:18:29	\N
106	Uaab9JRrzE1oSHYToqV7hpcq8c86VDCZFnOZ1H6c	Guest	2025-12-14 06:23:25	2025-12-14 06:23:25	\N
107	xXc8eCQP0IPeVhtF04nYk18K15BbAZljS0hQKlvx	Guest	2025-12-14 07:06:47	2025-12-14 07:06:47	\N
108	zHuDunIRgTGZB5s11NK91XxGT5pfGOnSVAN9hCYS	Admin Sixperience	2025-12-14 12:13:19	2025-12-14 12:13:19	\N
109	5oBuILlNBPeXAvzTx4uzi3aHF6M0XRQ2vrxkvkTQ	Guest	2025-12-14 12:21:28	2025-12-14 12:21:28	\N
110	kyDUgC7qgT5aJ2rKC8F2TuBOm2q3XsspdnQTvrRE	Guest	2025-12-14 12:37:47	2025-12-14 12:37:47	\N
111	YftCuKGtUqYpwCTwArxbRv1fGlTt57U3SQ1QLMhh	Admin Sixperience	2025-12-14 12:38:30	2025-12-14 12:38:30	\N
112	zgmDx04cQI9v5fOqDjFcyq5AACCWRIvCsNM2TvPA	Admin DNY Filter	2025-12-14 13:02:59	2025-12-14 13:02:59	\N
178	a0DJqa7Hi9Do7kMRNJdT8HoctpjR353xNWqm4BXS	Guest	2025-12-16 21:26:32	2025-12-16 21:26:32	\N
180	nmXEOWOBpcm5wsNMxHtOFFoX0HSh3dfyUZ38TsAD	Guest	2025-12-17 02:29:32	2025-12-17 02:29:32	\N
117	HQnfh39pjbCXM7vOl1SYrlFEsrOTCJnCSlNQTrQR	Guest	2025-12-14 13:11:25	2025-12-14 13:11:25	\N
182	dVEzI6ABxZmcxZjdP8k2qFf5EhbtgOQJWpcwcgnm	Guest	2025-12-17 03:54:44	2025-12-17 03:54:44	\N
184	1vtDYwgcRt1Zsvt5AuOkE4LpgEz5kR00GfomgzcJ	Guest	2025-12-17 09:58:41	2025-12-17 09:58:41	\N
186	hcfDzFMOR6H3LXlZDss9R6Z0K7gf7lvMpHP0G6PC	Guest	2025-12-17 10:13:11	2025-12-17 10:13:11	\N
188	GGLh5t9Eq4KPHQd1aJ4JFDfT2EVwki7W46Ebkbgh	Ghryshvi Dzickra	2025-12-17 13:15:14	2025-12-17 13:15:14	\N
128	XQnPz677fWqEe4OWOGJuqHwTZkOXrIjapNz7lXkA	Guest	2025-12-14 13:19:11	2025-12-14 13:19:11	\N
129	sRHMeb9xIvQmDB8wyeztvRvq1KeseDaeSUfW0B6f	Ghryshvi Dzickra	2025-12-14 13:19:26	2025-12-14 13:19:26	\N
130	a1J3Ez3UQl8mgHGZjdxNZzemUfGViqyRZRFuanE0	Guest	2025-12-15 00:56:50	2025-12-15 00:56:50	\N
131	WEqOii8xGTtQRIkS6Quaul6v9ufc946sGXIsSocd	Guest	2025-12-15 01:13:11	2025-12-15 01:13:11	\N
132	9Wr2MTRg9cNvKoDuYCiqf4jXiUjDPyVr2ZW1dQsP	Guest	2025-12-15 02:01:09	2025-12-15 02:01:09	\N
133	eXPAY8j1CABdDvd3u4AXKlkziwaKSpDkh38JU70k	Guest	2025-12-15 02:23:26	2025-12-15 02:23:26	\N
134	6EFw1oZwy4CF1pNLjC7H6BJS21oZpzBWJ5FAjyqi	Guest	2025-12-15 02:26:18	2025-12-15 02:26:18	\N
135	dORXVKaEniFbd1yVYtIeuuRtyIXR6pN0pWeub1oA	Guest	2025-12-15 05:30:47	2025-12-15 05:30:47	\N
136	pY8FoLvbG5YGsFP3vdq56DkTKAciN1DF13V3fZUP	Guest	2025-12-15 08:23:39	2025-12-15 08:23:39	\N
137	OmqHblJa33K4gvnz4bCqn13t6JG2Yvqk0Q0I4VpU	Guest	2025-12-15 09:38:13	2025-12-15 09:38:13	\N
138	6faW86HfQBiCJgjCJi1zYEMKBZClBgQlSqC2jfRG	Guest	2025-12-16 01:54:27	2025-12-16 01:54:27	\N
139	C5NYFimucu7TBtcvjl747PjFfHXc3MfOUVfRSuba	Guest	2025-12-16 02:18:12	2025-12-16 02:18:12	\N
140	fX8eqWliGOVOzLDRJu5OeD5cGjYJ4jKNlSZbuLmj	Guest	2025-12-16 04:25:46	2025-12-16 04:25:46	\N
141	MlF8I3ALvUNNWkGCVM3LoLylSrRhxG2p6uVgTArE	Ghryshvi Dzickra	2025-12-16 07:43:10	2025-12-16 07:43:10	\N
145	hnH1p2fDPID7UnTn8pDzDMtBj6nesFYymM3BqdQw	Guest	2025-12-16 09:47:21	2025-12-16 09:47:21	\N
146	mUgx5byeLRIZ5NtEuaijx8Heo9w3BSeYRIqPAYZ5	Muhamad Nur Salam (Alam)	2025-12-16 09:49:35	2025-12-16 09:49:35	\N
214	ptCPku2nLyTeyxqqat8KIL688zROMt90k8Lhrthj	Guest	2025-12-17 18:31:25	2025-12-17 18:31:25	\N
151	F7DQCqoByq9GqCE16IE4A6i6iqIzFYJYqoWClbAx	Guest	2025-12-16 09:52:00	2025-12-16 09:52:00	\N
215	5EsfySIWHfRPxwmVEs0zOxcV3q7lXqTd7uW1UZPT	Guest	2025-12-17 23:21:10	2025-12-17 23:21:10	\N
216	2aope0i8YnvNJYMAb3abq3dyvMCWSjnYXy0BWURb	Guest	2025-12-18 01:32:31	2025-12-18 01:32:31	\N
154	FQxbu5tcTsMGfJCUjyrTIjlCVZq6L4Iwj20ixfel	Guest	2025-12-16 09:53:33	2025-12-16 09:53:33	\N
217	AAkqp18ypNwCMjL0Ik54rSlk143vfnHAHO1SPemg	Guest	2025-12-18 02:45:10	2025-12-18 02:45:10	\N
218	BqFg511sQeVAONpsZQgtVwZWPdE3Mckcm23uH71l	Guest	2025-12-18 02:45:10	2025-12-18 02:45:10	\N
219	vVS2NuXWaxOgeRKYwxPG1VnwQAhmfX5msafzzVHq	Guest	2025-12-18 04:04:17	2025-12-18 04:04:17	\N
220	jjtkXQ6U3puWkzjnGKMx4DqJjvjLipQiWboLkA5O	Guest	2025-12-18 04:17:32	2025-12-18 04:17:32	\N
221	JNfgSgq4F3F7CEs3YZoyBIj9WPJeU5HWkYVlKkdE	Guest	2025-12-18 06:42:54	2025-12-18 06:42:54	\N
222	Tci9TScRTlgnrXUAWY4pAJOq8oXWMOSm1eXJsNWU	Guest	2025-12-18 11:05:59	2025-12-18 11:05:59	\N
161	BZwOPZOBRCnbUcXDAUDmIixo1zq1onNyJkXjm4vr	Guest	2025-12-16 10:20:49	2025-12-16 10:20:49	\N
223	X6P0Xo6m1Q7jhzCAYjqAE1CshPXhS0usi5KmLOQ9	Guest	2025-12-18 13:32:18	2025-12-18 13:32:18	\N
224	4aiMHA7oU3p413enuB1FIonKNyQLI7HOinZ9tX9V	Guest	2025-12-19 03:47:59	2025-12-19 03:47:59	\N
225	J2rUhDjWGhHXNy7tc9HoXQJKu5avTqKSi1becFOV	Ghryshvi Dzickra	2025-12-19 03:52:38	2025-12-19 03:52:38	\N
232	rTS2McWikJ7VnmkJmbWJjWxlnlvJR6JszBI1RHvZ	Guest	2025-12-19 04:43:57	2025-12-19 04:43:57	\N
233	1XWZEgxsxvMhypZ8n6vYzwkJxidt3JzpGGWII5Kb	Guest	2025-12-19 06:25:58	2025-12-19 06:25:58	\N
234	EZ6hvHijm1JeHUYYUZ5odhGpXt2Jk3dGVwDY2OWi	Ghryshvi Dzickra	2025-12-19 06:27:47	2025-12-19 06:27:47	\N
245	V72fNZVg3EhrnNeEjzgs9qJXOvBfnRQsNUpwkaWR	Guest	2025-12-19 07:20:14	2025-12-19 07:20:14	\N
246	vn3VPGlHpk9UHoEoQipWjybQnjyrhiQgDh4vU4Kd	Guest	2025-12-19 11:50:15	2025-12-19 11:50:15	\N
247	2n27BTwaTh1h7ZrE0Ah2GZxUr00qTPifehxtiIGX	Guest	2025-12-19 12:43:25	2025-12-19 12:43:25	\N
248	uTrj00cVZIaEsnIYGbQTpPf3m69KFAA7mLafEilj	Guest	2025-12-19 13:02:12	2025-12-19 13:02:12	\N
249	cenDmfqaPpIjAS5moTKTsnWoZ0Y9RGYxPws2uJcb	Guest	2025-12-20 02:33:19	2025-12-20 02:33:19	\N
250	9Il5nyhqSBuunI67paOTqU8o0i0PdZb331IriwuJ	Guest	2025-12-20 12:23:57	2025-12-20 12:23:57	\N
251	klI6KtqyAOAk0zDoCNvAfeBRCnLgcK1OQebxWvZQ	Guest	2025-12-20 20:25:10	2025-12-20 20:25:10	\N
252	8ojHPJomjWXngl0sgjrQPt3t7hMzUuTrP2xZv5nB	Guest	2025-12-20 21:31:35	2025-12-20 21:31:35	\N
253	BwJhofpubF74YUa0PpG98PJSOrDYmAALdEX0zDxp	Guest	2025-12-21 07:47:14	2025-12-21 07:47:14	\N
254	Mw7FDuZDMOk23JGHvOdamgWCPVNclyfPmrexDz5K	Guest	2025-12-22 09:09:38	2025-12-22 09:09:38	\N
255	ZOmnTPO7uYseFgr1SEg5cpHyX9szocCOpsoAZ8JP	Guest	2025-12-22 09:51:36	2025-12-22 09:51:36	\N
256	4Vh0YiaSX90ry6wWOJA6d3rFCyeUQSwy9jYb291n	Guest	2025-12-22 11:25:49	2025-12-22 11:25:49	\N
257	j7giYdn4ufqUQUHAXwvDYWhprD9fEnnLgjw8JvIS	Guest	2025-12-22 11:34:18	2025-12-22 11:34:18	\N
258	MI3SOMXVGBYCtIdWzhyRKWSqwLDecKNPENYMTMjt	Guest	2025-12-22 11:41:16	2025-12-22 11:41:16	\N
259	Yvs6sZrN83my3CE4aS8OJZBlcN0Lglj3BBFArRwP	Guest	2025-12-22 22:36:47	2025-12-22 22:36:47	\N
260	gTeVTpv9A5lTKDjiepSYy4YECCJ8SDXpMyFeakZr	Guest	2025-12-23 00:15:47	2025-12-23 00:15:47	\N
261	xVj2ljoyeivnw45I6lxXEELTwqDFUl2CvFKPugQ6	Guest	2025-12-23 03:01:41	2025-12-23 03:01:41	\N
262	ZvQuT9BfM2jLap2CUxPP1stysGS4eC0xhLE9z0je	Guest	2025-12-23 04:15:51	2025-12-23 04:15:51	\N
263	dGIwMG4EIo21kcF1x0bicpYwqmNoEKX7IjoMILzS	Guest	2025-12-23 04:15:54	2025-12-23 04:15:54	\N
264	VdbKQWoLaRh103pLo4fGJ7hgeDfAbo49lyJwb9Yv	Guest	2025-12-23 04:15:55	2025-12-23 04:15:55	\N
265	hKDlzJdmWkQeVHLnPhQTArKem7F0sPsqy4Xr8HDw	Guest	2025-12-23 10:07:39	2025-12-23 10:07:39	\N
266	HOwjpMcKYMwKeqd0AMxDpMKUdK9JS0r8xGAN4PDo	Guest	2025-12-23 11:05:02	2025-12-23 11:05:02	\N
267	J20BPsm0w96YuPq3molXBUeiRL0uPF9H2TbjaKgl	Guest	2025-12-24 02:27:13	2025-12-24 02:27:13	\N
268	OdkM1ZozvYPRVbAD3ateKReWQW0cYVlQlNXdbr8N	Guest	2025-12-24 04:54:41	2025-12-24 04:54:41	\N
269	WfISmk2ZyGatZ3hNL1CfGPhw6cCXZDehG9iQ6rLR	Guest	2025-12-24 06:48:48	2025-12-24 06:48:48	\N
270	v1pRIWpEOxCfx7u24dGL2uoOUeFTnqsSTlUnDmCH	Guest	2025-12-24 06:52:34	2025-12-24 06:52:34	\N
271	TSPe5QilPRoQv3Ln8qs38rMdn5j9l3gVdjrpaAnn	Guest	2025-12-24 12:19:57	2025-12-24 12:19:57	\N
272	OxM7KerQF6ZuWQmqMCDh2M0vPWNOYvCrodARJ1o5	Guest	2025-12-24 12:29:41	2025-12-24 12:29:41	\N
273	bnVQKRgRAHmiDZRoE54A4NlFKZ6vG6QdnJ7GLfNu	Guest	2025-12-24 16:48:58	2025-12-24 16:48:58	\N
274	Gce9xnIBi0UDBVoojYqdlE3eqnC2UjhHtuhD6Qh2	Guest	2025-12-24 19:07:30	2025-12-24 19:07:30	\N
275	qwD66Yo7UHY9uSFrmJsUh4IDPf0kdzfK1wH8JsOx	Guest	2025-12-24 19:50:37	2025-12-24 19:50:37	\N
276	vP500yuGtOGjAdA3znLmvc3QzK9Nm7aDxhaTVIzF	Guest	2025-12-25 03:36:09	2025-12-25 03:36:09	\N
277	f6yuOuuZcoOZJ8o3RMpy42j7DQMJKCI6mPzXDlPF	Guest	2025-12-25 12:20:28	2025-12-25 12:20:28	\N
278	VtSjgZKEHCLgqYKMtOqpVU8UbBX3uP06YBS29DSS	Guest	2025-12-27 07:02:15	2025-12-27 07:02:15	\N
279	hVOYVjxmTzZLoWnG5Hiu3OP341xDnNSskjc8ECvf	Guest	2025-12-27 10:49:40	2025-12-27 10:49:40	\N
280	vKQQLAsdExMobrWZqdEKj2O0NxBum3xBQYU3Zj0f	Guest	2025-12-27 11:11:04	2025-12-27 11:11:04	\N
281	Ha0slF1oiW6E9IKKAUiedZNHOHoFxfgLSKMBsXLA	Guest	2025-12-27 21:23:08	2025-12-27 21:23:08	\N
282	VPa02Da3bCQ2UEjSl1sVzYaJjHydoUDGuhL1NHhi	Guest	2025-12-28 01:35:52	2025-12-28 01:35:52	\N
283	rkkwWkUp5zHiE6ND37XK58vznpIzTOH3gpXcDEpA	Guest	2025-12-28 01:59:49	2025-12-28 01:59:49	\N
284	EKrwHvJkhbCbC08nc5QFzKCkpEHDccYKGMBUSrVa	Guest	2025-12-30 03:48:51	2025-12-30 03:48:51	\N
285	2KF1tv9cpqBnMQgCun92LfTLHhnXA97um6h0U0yC	Guest	2025-12-30 04:17:04	2025-12-30 04:17:04	\N
286	fFafBCLnOgdfw2WN0I0y2zvIo4tTwnZC4ie0yHP8	Guest	2025-12-30 07:10:41	2025-12-30 07:10:41	\N
287	PUNQUCFUQF6i1HXCvAr5l61xePUTtShnijVTxlHB	Guest	2025-12-30 08:45:48	2025-12-30 08:45:48	\N
288	Dm1Sngv6iEvH7JWgyu17K8sfDMGhC2pfAtj5PYxH	Guest	2025-12-30 08:52:58	2025-12-30 08:52:58	\N
289	XqusCmtfqMXfjh7sw6w9HTId59uuNF5Idcik96xs	Guest	2025-12-30 10:32:58	2025-12-30 10:32:58	\N
290	J9bRoE0mFaIipgINGJAfghxNRXySd3PUid20S0pQ	Guest	2025-12-30 12:08:59	2025-12-30 12:08:59	\N
291	JMeBtYZbgh2bE8wharmBU9LYNoaCa331RCrjT8Wz	Guest	2025-12-30 13:49:56	2025-12-30 13:49:56	\N
292	lczxYcN31LNjQKbcJsqnSXtJn80xlzhdyOuRknJG	Guest	2025-12-30 15:34:00	2025-12-30 15:34:00	\N
293	UNyX2i15qg15sbjDembLI01uKInByUW81WovwwLG	Guest	2025-12-30 16:48:02	2025-12-30 16:48:02	\N
294	5sO89xBxte8ywLT7xtcn84YptzTy4yukACZUbRUk	Guest	2025-12-30 17:16:54	2025-12-30 17:16:54	\N
295	gPA6TnaJEbqDYz74E6ZvxCLf9cSVyaAVvKAvC47G	Guest	2025-12-30 21:54:25	2025-12-30 21:54:25	\N
296	emxZ7MML98VtJ6oreMH212J5kTbXuH6d8QWeNYa8	Guest	2025-12-31 03:45:40	2025-12-31 03:45:40	\N
297	3ExYoTFZvpKCCwon6VwcjItAabh9jrIKhScKZLvi	Guest	2025-12-31 04:27:52	2025-12-31 04:27:52	\N
298	vqXWPV8KO8ZotAbh315PcRlqaTWZVqS5la7LzVdt	Guest	2025-12-31 22:03:18	2025-12-31 22:03:18	\N
299	VWNCymXDGyRGyJN8v3RE1KgLkJuHowTuqEF983yd	Guest	2025-12-31 22:03:18	2025-12-31 22:03:18	\N
300	7388dSNRZF5pgo29xTnohzjXI8baqHib3i4TZtqh	Guest	2025-12-31 23:39:32	2025-12-31 23:39:32	\N
301	xfHrYSQQNoDGoFRMBPOBoyKWMVQsb2mMGkntIvRk	Guest	2026-01-01 00:36:23	2026-01-01 00:36:23	\N
302	Y7EbPrlzvOPzgMtKHdRygJX4eFZt5MeP1EPIymLS	Guest	2026-01-01 02:31:06	2026-01-01 02:31:06	\N
303	hg8ojmJ7ttkXY09EatAy0ysUnglp7k93Byk2Ibgd	Guest	2026-01-01 04:58:07	2026-01-01 04:58:07	\N
304	YlYNaAD5C0JJPYsIp2VySAtNaxVPiWVqm5sKkkjK	Guest	2026-01-01 10:36:02	2026-01-01 10:36:02	\N
305	zmvHOxBwu6qutr3BJbkJ0QA87aM0HnXnWPiZKdga	Guest	2026-01-01 10:41:49	2026-01-01 10:41:49	\N
306	er2J6WEugkZC7DEr0gySruv094CqUaSBoVoIkSyb	Guest	2026-01-01 13:12:04	2026-01-01 13:12:04	\N
307	NppfnivEcIbD9YOTXgYuSR2sJ8HbRgZYdLwKJgbe	Guest	2026-01-02 08:43:45	2026-01-02 08:43:45	\N
308	w7ON2JjPN5BapHzsUjqeOxsiVrWEIxFaCliqVY6G	Guest	2026-01-02 13:50:39	2026-01-02 13:50:39	\N
309	jQc00oMsJfbA0Jw8qmj8WL9qjwbr7KOwB6qom0uO	Guest	2026-01-02 17:18:05	2026-01-02 17:18:05	\N
310	KhUkCFqJV9ymahmFijbYmJOYxQzBzknpT1CSGYL0	Guest	2026-01-02 20:02:02	2026-01-02 20:02:02	\N
311	01oHCpmM62efymGyIiB02WVcaobj4Kgm9GJowmOR	Guest	2026-01-02 22:05:38	2026-01-02 22:05:38	\N
312	YFiVUZ5YGPRJnrjVJjKUgSRLWa6Bel8zMAORjIa4	Guest	2026-01-02 23:22:09	2026-01-02 23:22:09	\N
313	Rrb17zsRtdlk3iwWd6kXimXG7OBLahpFbAD7dc5R	Guest	2026-01-03 02:43:14	2026-01-03 02:43:14	\N
314	P67Dh0d6AMsVLt1d7igo7gLS0tX175Bh53Zz562Y	Guest	2026-01-03 03:49:25	2026-01-03 03:49:25	\N
315	6j9Nn5Mqocjk3FNy2x6oxjbOwxPJpcbJ5XhncLeN	Guest	2026-01-03 09:50:19	2026-01-03 09:50:19	\N
316	CMcWmjZRIuyXLxORhIlQrhNczOOzOaGWaWTlToiT	Guest	2026-01-03 10:11:56	2026-01-03 10:11:56	\N
317	yQpjtgfBXibf9PeAOS8X6fJmsyNKmDUg7bQSGaGy	Guest	2026-01-03 12:05:10	2026-01-03 12:05:10	\N
318	shPptT5K0ovL1TBiRDmVME2fBXvSd5FRPYDURp2S	Guest	2026-01-03 19:33:29	2026-01-03 19:33:29	\N
319	UygRS6DckXGsRSR87J1RPSBJTmNfPp8wGoefjf0U	Guest	2026-01-05 02:01:10	2026-01-05 02:01:10	\N
320	D6jQLGRHuiU6NahGZNaP4FVPOzI2ugCI7bDnGDxz	Guest	2026-01-05 02:21:15	2026-01-05 02:21:15	\N
321	0Ts2HEBP2guHlMs2mckrX2zoXAqvOzsX98BQVpXi	Guest	2026-01-05 02:48:04	2026-01-05 02:48:04	\N
322	wt94t9Tzf7EDT69UFIa6wN31PJLV40nSsXzaqcqj	Guest	2026-01-05 03:45:15	2026-01-05 03:45:15	\N
323	kZyEtdgeHk7Ayn2IURZfCWFhqThTlXAkP53nt2TZ	Guest	2026-01-05 17:43:20	2026-01-05 17:43:20	\N
324	YNkQtxeCSwIag2Pkq8kUhLmTTkKbmlMWE5nwvS03	Guest	2026-01-05 17:43:22	2026-01-05 17:43:22	\N
325	TwLX5gl0cnp6xF7fZlvzofmhXbq4mFWadgfA3xv4	Guest	2026-01-05 21:18:57	2026-01-05 21:18:57	\N
326	GEWSDnpSR7h3uV7NcRdgToul6GsQZn1GzO00lrd0	Guest	2026-01-05 22:13:59	2026-01-05 22:13:59	\N
327	ovT1gisp7dM9ZStYLcf8kRogerKNtgVEKgo6s2nG	Guest	2026-01-06 08:35:45	2026-01-06 08:35:45	\N
328	fciDrLyWgwVISHF5EFmPW8Iw5dhZHZpc5Wod5CZI	Guest	2026-01-06 16:14:42	2026-01-06 16:14:42	\N
329	UCdvZm6OdQYCMKJWC0E1MOZWA789XgAka8eU0ce8	Guest	2026-01-06 16:15:23	2026-01-06 16:15:23	\N
330	g6KMJhsOK54QRbACjRwB5nzioyH0ogGydvhAhsI2	Guest	2026-01-07 06:10:57	2026-01-07 06:10:57	\N
331	8uDoTdiIuZ2wmFxxLAXMKZ0j11f2qdzSW3pXtTvJ	Guest	2026-01-07 10:34:06	2026-01-07 10:34:06	\N
332	LIe0WRomIwc8dmm189aG7Pda9LA4v435jfYlztr7	Guest	2026-01-08 14:12:11	2026-01-08 14:12:11	\N
333	HoLyLQmeO9NhfeECihu2RKOBc6wN6CbAUsZ3xzRA	Guest	2026-01-09 04:21:54	2026-01-09 04:21:54	\N
334	p6xAOjKmX7gPnODVoVRt8TLEofbcXLqupEw1WtJq	Guest	2026-01-09 04:59:24	2026-01-09 04:59:24	\N
335	lKVAS31tkVDlPsdLoXjfobdsdxfTXKEP5NjwDyRc	Guest	2026-01-09 05:37:54	2026-01-09 05:37:54	\N
336	dBFdzks8q1ZhEgXEjXqqQkkDxbGFhLwgktqQZxLl	Guest	2026-01-09 08:41:12	2026-01-09 08:41:12	\N
337	MftivwYNUNyS951WiWqbfOXWasLsXkrtn7lLKqxO	Guest	2026-01-10 12:53:25	2026-01-10 12:53:25	\N
338	EyCKsUU8LQdUaF5Mfhia6ivEcPh8AE8xwFbFWQeO	Guest	2026-01-11 00:15:20	2026-01-11 00:15:20	\N
339	KB2hCOXEPP7YPNEZqXQ4Xp1R7z8g2IcrgAUJO7qf	Guest	2026-01-11 00:44:18	2026-01-11 00:44:18	\N
340	YdBi97rfykS33tYLrbRoV4Rnk3yV2KhCvESSUBkA	Guest	2026-01-11 04:54:36	2026-01-11 04:54:36	\N
341	2TZ5c5fjfzLlBfv5wL34bVGaupc3H731PHN1tgoI	FutureCloud Official	2026-01-11 05:16:28	2026-01-11 05:16:28	\N
343	ZSPMe05QpqXgIquInt1X37R9EmUS4AFfEPHwPhrv	Guest	2026-01-11 08:36:44	2026-01-11 08:36:44	\N
344	RZo9FDXFWaS6YZEUFWiPSNNQlRtEkORKuOZN5RYX	Guest	2026-01-11 09:12:41	2026-01-11 09:12:41	\N
345	vOcyOtneiGs3c4EQWDqOja5pvJaXvJLahsHi9XRp	Guest	2026-01-11 10:05:44	2026-01-11 10:05:44	\N
346	7HoXPSxM5vcCuvBUeVA8JHbY236eLOQuoESprnG3	Guest	2026-01-12 02:45:00	2026-01-12 02:45:00	\N
347	MuuDWXMJzkFBgo3tF5R4JCdAa32bifj7bQjVJqMg	Guest	2026-01-12 09:21:48	2026-01-12 09:21:48	\N
348	X4yzSvOGW8UMAucjBHYciIXaAxP5YqAImM45HsGt	Guest	2026-01-12 11:51:47	2026-01-12 11:51:47	\N
349	FFIh0sNsFCcYIGgTfp76okztIa4vqTKUktVp3qLf	Guest	2026-01-12 13:47:17	2026-01-12 13:47:17	\N
350	xaIhZzIKWJIEYEE0a8cwGuI44kXbSslGOcrkxtio	Guest	2026-01-12 13:50:47	2026-01-12 13:50:47	\N
351	7SDSdB1oJa4jteB5lv5lRhwc8AoxyCT900IyfPR7	Guest	2026-01-13 01:57:52	2026-01-13 01:57:52	\N
352	6LnheEnpN9IxVdvVuqmTuJVlvVV0SfGoAWwLvDjf	Guest	2026-01-13 05:28:31	2026-01-13 05:28:31	\N
353	u7HqugpmqYzCij8Im75VDOxcJqYaKrjy7t2Wrbxb	Guest	2026-01-13 07:43:22	2026-01-13 07:43:22	\N
354	mUlsMMSjR5P8oqq0yu9F8IJQB1F0B1kDRsxP6N1R	Guest	2026-01-13 08:50:36	2026-01-13 08:50:36	\N
355	PRIsFSjpdiN3uB0XB3uV2qTfu3Sv26XfKbBM5B3E	Guest	2026-01-13 13:11:18	2026-01-13 13:11:18	\N
356	DSXyzr8yO6CnzOuopzZ6thYrlh7jQAk9BsXPNFL3	Guest	2026-01-13 13:15:50	2026-01-13 13:15:50	\N
357	jQc09SshzKC2FPoJlyIPasqKEdWACUKF02T9Og95	Guest	2026-01-14 00:55:11	2026-01-14 00:55:11	\N
358	yEVZswbFEiA7tRbwIFx30mw3ra9LdZZDFzAYgzOz	Guest	2026-01-15 03:20:51	2026-01-15 03:20:51	\N
359	8YossOjxD27ysyZGsKFTdOnPoqqZnZswDFXrVF60	Guest	2026-01-15 05:42:53	2026-01-15 05:42:53	\N
360	HUaWFVVoHpnjcG6UHYgCGXBa9VFh0dal7eaNG8sU	Guest	2026-01-15 06:49:59	2026-01-15 06:49:59	\N
361	U41dBZSmBr41OgjJfI7vOJTHNhfk5Z78zEP4QNeJ	Guest	2026-01-15 08:15:06	2026-01-15 08:15:06	\N
362	Moz2JxEZMt0IW0Ea7tun7StH7vWB6scRFIxfSseN	Guest	2026-01-15 09:31:29	2026-01-15 09:31:29	\N
363	vTcjG5GfumbvP0yIezZSFvjptAFSeJeI8h834uBR	Guest	2026-01-15 11:28:55	2026-01-15 11:28:55	\N
364	06X6MRSjNDyKfNrO09RQ1LAbubBbTTvfA8MfqHGE	Guest	2026-01-15 13:21:31	2026-01-15 13:21:31	\N
365	IzfaYKJvC3YmmUIX1YeJu3Xm2wTYcC70FpNvvUur	Guest	2026-01-15 13:40:14	2026-01-15 13:40:14	\N
366	djMsTj0GHHs076Ea7WwVcKZeYx8xpBG5oN5RWEWb	Guest	2026-01-15 13:56:06	2026-01-15 13:56:06	\N
367	7dJxKNrXcKY1HP2uUrVE5B3Ohmdu2rOVejwEohkZ	Guest	2026-01-16 02:14:26	2026-01-16 02:14:26	\N
368	Qao8ih3hN34M25YPlKq4tnnPMjeEVu5KIApXKIKB	Guest	2026-01-16 06:51:51	2026-01-16 06:51:51	\N
369	yRTyQ5cyny9DreO20xwK0xyV8MXH1htgh3KyosgX	Guest	2026-01-16 19:27:03	2026-01-16 19:27:03	\N
370	3LPCaygDi0gQwN0aXUjJmAs9f9evdapi4hdFBd4P	Guest	2026-01-16 19:27:49	2026-01-16 19:27:49	\N
371	7IMzIr3XRMnNXrjZsMoRcMREqFAbRkNu7kif64Ju	Guest	2026-01-16 19:27:50	2026-01-16 19:27:50	\N
372	2sEXMNoazexoDaGam9SFfll6dTIFgOvz3Befb758	Guest	2026-01-17 07:25:50	2026-01-17 07:25:50	\N
373	xADilYm0CCVF4cWDMTziG6LD0iLNa7oUkssP6jAo	Guest	2026-01-18 02:51:47	2026-01-18 02:51:47	\N
374	B7VXtlTg0JNqGxxhBCUrCzfVa1Yzt1O2dSJu6xwO	Guest	2026-01-18 04:08:06	2026-01-18 04:08:06	\N
375	Ak9WbY3sYDFpWJS214Eu4PQv6Evfk2Sx60jhQSGA	Guest	2026-01-19 04:23:59	2026-01-19 04:23:59	\N
376	bKhiNEJeacCqKyWyFHHrZYyJG38Hazqjrz2uSdsM	Guest	2026-01-19 11:37:12	2026-01-19 11:37:12	\N
377	4JXheUZDLnRKd8lmVmhZVokViZvlNhOyGLeWcbcK	Guest	2026-01-19 12:38:43	2026-01-19 12:38:43	\N
378	CUjpC5L5Oe4eLicfiFaN8tjqiRjhdS1aRWeBukU9	Guest	2026-01-19 13:59:02	2026-01-19 13:59:02	\N
379	YMjJF6d6h2wUANQCS9HNNdQ6DTu5vlROcxVDCdC7	Guest	2026-01-19 22:05:52	2026-01-19 22:05:52	\N
380	p0NpKPvJKxjBSx4IYuE865QNIcJGjXXqz3uGOej8	Guest	2026-01-21 01:12:29	2026-01-21 01:12:29	\N
381	waEHXkivoLIyC8S5FuqJIczME399A7VETSdmUIBQ	Guest	2026-01-21 04:50:45	2026-01-21 04:50:45	\N
382	GTsllloYQrYlO3knT79a2GL54lZGNSq405W6WWBB	Guest	2026-01-21 07:23:34	2026-01-21 07:23:34	\N
383	ALdRzP8FDlkw1IyIa1PoFIg4aUZwZCQLLuGsC2mB	Guest	2026-01-21 08:44:18	2026-01-21 08:44:18	\N
384	tkNdotrjANlhaQkyRLRYDNz6jZV12zv0XIDblDvr	Guest	2026-01-21 08:44:23	2026-01-21 08:44:23	\N
385	CHI6xgLf3h5YqI0fXsVic1bnlbkqhdPLSo3KZ7wj	Guest	2026-01-21 08:44:24	2026-01-21 08:44:24	\N
386	YOq2H9eDkw5hjolM4c7oiU7SAx8ciQKgbNTTmhTO	Guest	2026-01-21 12:00:48	2026-01-21 12:00:48	\N
387	Em3q1ZSSKPSreOymz31SwgEfu9Nf6pBxP4bkXL0p	Guest	2026-01-21 12:02:05	2026-01-21 12:02:05	\N
388	JAbSpgQCQKoVwANj0yiSDx2rOIoAN17CCNF0Oidl	Guest	2026-01-22 10:03:48	2026-01-22 10:03:48	\N
389	6bNyA2Ny1QmRdgcQLkWnLNEv5EzVwCIXqF6FElOw	Guest	2026-01-23 03:42:54	2026-01-23 03:42:54	\N
390	TCroUpEgFfayZauA82LoWpiOtXCLSwlsgB0gWzBB	Guest	2026-01-23 03:45:25	2026-01-23 03:45:25	\N
391	rdD82hhFhyjZJKhZGRNaqbcdzd1ZjZo70Mo1NFTX	Guest	2026-01-23 07:10:29	2026-01-23 07:10:29	\N
392	s5DsSUS6KKOLUmIHFSM5RijrkMZhaDeMBofULfJn	Guest	2026-01-23 07:10:52	2026-01-23 07:10:52	\N
393	DTcKehqeI8XBaczub06lYS8gtS6E1wA5vgpdlgRt	Guest	2026-01-23 07:11:19	2026-01-23 07:11:19	\N
394	fYYRE1pGTMmTHujl6bAxAVk92N2TnTEgO1btVEGZ	Guest	2026-01-23 07:21:05	2026-01-23 07:21:05	\N
395	qfoI2966zCqBkRB74Ut5JDaCSqgXCr8gMU2Ym1E7	Guest	2026-01-23 08:11:40	2026-01-23 08:11:40	\N
396	WePOCIjxCQ6SkIiSZFLYUWNGxRg3l5GApLhffwUb	Guest	2026-01-23 10:53:33	2026-01-23 10:53:33	\N
397	dhqCU6Fp8ILZQAYOSz355f3ULSjosqhWbDQi5qc5	Guest	2026-01-23 12:05:10	2026-01-23 12:05:10	\N
398	27Gvy4qHBNRtK5ulO3F0k72X2VCrxqZN3WNljtmh	Guest	2026-01-24 05:58:13	2026-01-24 05:58:13	\N
399	OSRepvsShYcl0WFoesd3Q33lGAGG2SoTI276QIJD	Guest	2026-01-25 00:07:33	2026-01-25 00:07:33	\N
400	utJFdrYXNtqi4RZvtFnjNmLx9IcP3MMi8zoGPTJU	Guest	2026-01-25 23:50:19	2026-01-25 23:50:19	\N
401	AFyNGk3XqcMOyEu6QW6GlRDCAUwNr0uEVVo29eBQ	Guest	2026-01-26 03:22:57	2026-01-26 03:22:57	\N
402	omdiUIsVAo2ubhNVwkDDlyPVbooWBpsl6glzKcQY	Guest	2026-01-26 04:18:43	2026-01-26 04:18:43	\N
403	HpnFLxBLxRlTZgEIHC0Splq6OrZkJ8BXHZ0NH8v6	Guest	2026-01-26 04:47:02	2026-01-26 04:47:02	\N
404	Ufy9RN181w9Uusg3t7XyGi7VuQgNcKHoESJTp6PB	Guest	2026-01-26 05:20:57	2026-01-26 05:20:57	\N
405	xlOXgYp7hs5dhLaw9od04ruTg3brdd7LaPuOCzsU	Guest	2026-01-26 05:23:39	2026-01-26 05:23:39	\N
406	2atBrMCDz95S0uLXlutquPDkYRCN5EzIdGfTe1DY	Guest	2026-01-26 09:15:11	2026-01-26 09:15:11	\N
407	czcB1f1rNjhVF7fH1huUMIA9c8HJqjuzkNMSboQ3	Guest	2026-01-26 17:07:53	2026-01-26 17:07:53	\N
408	rx75l2OFMsKaSgSqgELR8Tb7EB2MIxGydIqdRpLS	Guest	2026-01-27 02:39:04	2026-01-27 02:39:04	\N
409	5JRKPUmCQFjnJzoUBYjuXUre0GtnJVGXZPeHE1nw	Guest	2026-01-27 07:18:44	2026-01-27 07:18:44	\N
410	AS2HLQHlmK8Yl4Qywqg0ylQrBnIT7pKvteV2DkN2	Guest	2026-01-27 10:52:10	2026-01-27 10:52:10	\N
411	g41R6DPmXjgKIbXDogIuZCwtttyGDmBZQXlc0mGJ	Guest	2026-01-27 12:04:43	2026-01-27 12:04:43	\N
412	gyjGRvlNfP3LDgqebrxJfTn4sW9SMm8gioV7iq5f	Guest	2026-01-27 14:05:12	2026-01-27 14:05:12	\N
413	rwxG2vfEfPBfTmK5CRk6gWVbxtgivBVt6hHbgBh0	Guest	2026-01-27 18:15:10	2026-01-27 18:15:10	\N
414	B50ioFXYFS9XFVTqGfoYG2Hugx7QowPfhPqRpIxa	Guest	2026-01-27 21:35:07	2026-01-27 21:35:07	\N
415	DevWKGm4iVCJJpBudEr6OXNm7CgfjghfDtz1xh13	Guest	2026-01-28 03:36:11	2026-01-28 03:36:11	\N
416	9e0Y68ooIK48C22sxEEiJNHiRUiXxoYQrg4dJ8Yb	Guest	2026-01-28 11:19:09	2026-01-28 11:19:09	\N
417	e7Buho7MOVbu1P356ZhNb7vSkQ6Dj7f2t00NaO89	Guest	2026-01-28 13:47:28	2026-01-28 13:47:28	\N
418	a0vYoUiK8o3bmZzF1g5dI1ESXPYYpdZlNtBUp5f8	Guest	2026-01-28 14:50:36	2026-01-28 14:50:36	\N
419	PLLx1iE5R4M5sf6M9hSJ3923fGgHJE0mlC0hfLYm	Guest	2026-01-28 17:38:26	2026-01-28 17:38:26	\N
420	NYaNvGlRPqPRs60Qneq4Gl2cSyL8eM8p4FxkR7Uj	Guest	2026-01-28 17:38:26	2026-01-28 17:38:26	\N
421	73cZyEDPp6IQnhFmLMKKtxthOBrQRi9NIWCmJRXx	Guest	2026-01-29 04:32:29	2026-01-29 04:32:29	\N
454	5nQkFtFjSGL55XZ7w56HeVICO7n7qLVYxO2ev4Qe	Guest	2026-01-29 08:55:14	2026-01-29 08:55:14	\N
455	joF3bjOjOXzKjd9u4xdi0RJKKUgn5KKscycdNeYl	Guest	2026-01-29 09:42:39	2026-01-29 09:42:39	\N
456	gQNID8MiacemLmn1aUR2O8ym6Z0xNrGI153kthEd	Guest	2026-01-29 22:49:44	2026-01-29 22:49:44	\N
457	MLKSeuJILjjR69d7CLSMV1LFbo4tVoDT6g0R8ZOx	Guest	2026-01-30 07:31:47	2026-01-30 07:31:47	\N
458	855vrCGuKnCwpI8u3NOmiZcbsxpNbMZG8xLICEvL	Guest	2026-01-30 07:33:56	2026-01-30 07:33:56	\N
459	G1OHaAjBMVevBPSQvqCEJCbzdus68rY1M7It5Wy4	Guest	2026-01-30 07:57:46	2026-01-30 07:57:46	\N
460	h8EnQPAHSQN3aCn9oTtvkMcNsQrWybsTYRk9faET	Guest	2026-01-30 14:32:10	2026-01-30 14:32:10	\N
461	uZdhfrmnkkwj1ZkMOy29Ph3xFljzPgR2FVjDGd04	Guest	2026-01-31 10:22:40	2026-01-31 10:22:40	\N
462	XXckzSNCSYjwLqx75fv2zJ9ZCTqb3vDbe9VVVHqa	Guest	2026-02-01 07:17:39	2026-02-01 07:17:39	\N
463	h7kOdmproY6coVhtM6aQNJzXtWLk3uEydfSZAJ8O	Guest	2026-02-01 10:33:37	2026-02-01 10:33:37	\N
464	S03wPtcttdu6jzqChaTJdLUpbgmbbwoNMcbGQkOS	Guest	2026-02-01 10:35:18	2026-02-01 10:35:18	\N
465	Y8wgLn5bh2st16sqKlVUPu1FTnHGsP6AldWR5Cvy	Guest	2026-02-01 10:39:06	2026-02-01 10:39:06	\N
466	tSO6o3fEzegO4nuv6c3RvLmyWHNaw2jNCnTsnyig	Guest	2026-02-01 11:19:51	2026-02-01 11:19:51	\N
467	snufByzQ66exc3cjem0silWieoYYKzxMVO4HKG6Y	Guest	2026-02-01 11:19:53	2026-02-01 11:19:53	\N
468	4eVtYj69Domerov7lVz3EMxeW7IROtAaZv5sAM0O	Guest	2026-02-01 12:12:34	2026-02-01 12:12:34	\N
469	X8pKTYzyM4L74g2E4jNS39xeGM3iT9G9dUyX4zAP	Guest	2026-02-01 15:09:19	2026-02-01 15:09:19	\N
470	TzZ1mmS1YJnxmFaLovgzaKdrmtrj0HrUk9pdvWyP	Guest	2026-02-01 20:15:59	2026-02-01 20:15:59	\N
471	r5A7ZwPHoN9tanf7sv14MUD49Sjs75CC0IswZ5IG	Guest	2026-02-02 01:21:47	2026-02-02 01:21:47	\N
472	PH7A7llyWBwEWApBY8km6DmoRS0VY6XjaDFrhgQy	Guest	2026-02-02 09:00:02	2026-02-02 09:00:02	\N
473	DNy54vi4WgCOlE37IHnOS8yUNHaBc1Qf4eHhrPWA	Guest	2026-02-02 09:19:36	2026-02-02 09:19:36	\N
474	w1HAUSvgZD3EDZP0sviNTtpNJ6q8LAEh5XeFLpWV	Guest	2026-02-02 11:25:52	2026-02-02 11:25:52	\N
475	mZLPIU8HvvISdGTe9UoQoUpTHPE4essN6pSCR9FN	Guest	2026-02-02 11:26:02	2026-02-02 11:26:02	\N
476	p0cSQu3aM6wfxvWPzl2XLpWZ1HYP5H0b4Vj3WIuA	Guest	2026-02-02 11:26:04	2026-02-02 11:26:04	\N
477	YzKFfZUOfSfZGb2A3QsZLShZ9nNHf4zXrl0kHb50	Guest	2026-02-03 01:59:28	2026-02-03 01:59:28	\N
478	WaySCR9iC54YHkOka79YnwqWvmTulZKfPtukgNnz	Guest	2026-02-03 03:36:30	2026-02-03 03:36:30	\N
479	Uk2HtU1moDs6PXXNbnwZhduuQYVRxReEeY4n5iM6	Guest	2026-02-04 02:05:00	2026-02-04 02:05:00	\N
480	Z7AcYP1FdkghUsQoE22qUuoKIsOoUwEQNLrf1MWk	Guest	2026-02-04 02:55:59	2026-02-04 02:55:59	\N
481	wGjiC3LIclbsCsnrFE9CIx0o2cf59nw9BZdmQ3cv	Guest	2026-02-04 15:43:20	2026-02-04 15:43:20	\N
482	mWDPedZgMAiSPjee9MevCy0dSRh6uessLQoJ1lAy	Guest	2026-02-05 06:57:50	2026-02-05 06:57:50	\N
483	0d3E2qqwFRTd9qrL9bxyUK7ZYv3tyik1YObONYf7	Guest	2026-02-05 07:23:27	2026-02-05 07:23:27	\N
484	pHMn6m51di2pMccwGcjDUP2U5Q46RJ0gEey1j3hI	Guest	2026-02-05 07:25:09	2026-02-05 07:25:09	\N
485	WJ3b7TT6kp1HOGAHQXOG8I3kaqI1mOsbhxz9eI7o	Guest	2026-02-05 18:20:26	2026-02-05 18:20:26	\N
486	6krDkQfga30yK93H7SpDXiCPW5E1g6oLHmjwDJpI	Guest	2026-02-06 00:27:28	2026-02-06 00:27:28	\N
487	zn7SnRjXr3CI4Nhw79HxW1axBsZKp1yoYT1rIHPo	Syahfiq Hikmal	2026-02-06 00:41:28	2026-02-06 00:41:28	\N
496	WJWliyoId8scrmis89UmFw0d8giD491zXgRoEAb3	Guest	2026-02-06 14:52:48	2026-02-06 14:52:48	\N
497	WjbTsSGTqmC1Gc0AU2YfFGFg7DYWi7g0EpXuwCg3	Guest	2026-02-06 18:01:27	2026-02-06 18:01:27	\N
498	QeioJ8hWDiuvFGiZNrdgcSkpxBtL7lzy2CObVKOZ	FutureCloud Official	2026-02-06 19:07:54	2026-02-06 19:07:54	\N
501	vzIqu5tusahF7ImBKNyiw86iBqSBgQbaahYte72i	Guest	2026-02-07 04:19:15	2026-02-07 04:19:15	\N
502	RquI6au6qHTXdfZOG94Uwm5IXORnMiW1MxPDY5DE	FutureCloud Official	2026-02-07 04:20:34	2026-02-07 04:20:34	\N
504	IUUR7ydK2hKszHEMDbbQ89PnOb1Au5LLIU2Zvwdp	Guest	2026-02-07 04:23:24	2026-02-07 04:23:24	\N
505	sGfxvnanAQA8NS9Ou3Vx7W7OwAh2pV392SG7t2Ut	FutureCloud Official	2026-02-07 04:24:08	2026-02-07 04:24:08	\N
514	XiBU11ZKk4VaoMbqJZSqP6Fg0YXCke4lnLCPjmQY	Guest	2026-02-07 17:11:27	2026-02-07 17:11:27	\N
515	4DwiCApN2CDc74etAVu4hp3hkD3YT68P4THK2DsA	Guest	2026-02-08 04:52:58	2026-02-08 04:52:58	\N
516	R8wZJ8TWp7sXd73j0Yl2ObaDUdExex0d2AQPms24	Guest	2026-02-08 09:50:12	2026-02-08 09:50:12	\N
517	15Vhl5E5Ys3FlvDLR9xFTOwaaX865aVJyvAqqr9N	Guest	2026-02-08 16:25:57	2026-02-08 16:25:57	\N
518	85GJkqsHQcjUczNUYTE4AHsccPHfadgGAgSQQrWG	Guest	2026-02-09 06:05:42	2026-02-09 06:05:42	\N
519	Nbqvcii0ZvhmfOebHOqSKpT3bkWPXh6g0vStu8Tc	Guest	2026-02-09 06:44:32	2026-02-09 06:44:32	\N
520	1gljbKLqmaN4LCwVDRbNn9D69gFcP8hYTy1pW0y1	Guest	2026-02-10 01:07:53	2026-02-10 01:07:53	\N
521	8F4F1WB7QdCXywcovABIG65fduVV4hk2zR0O0SyB	Guest	2026-02-10 03:53:44	2026-02-10 03:53:44	\N
522	ouSAp8luOL1QTrFrOBOltBOif0amimgp1SNuIUq8	Guest	2026-02-11 02:59:19	2026-02-11 02:59:19	\N
523	g1JIrzYGWB06WX6cD51UoAwnsUnXIIO0yX2VQqk1	Guest	2026-02-11 06:31:11	2026-02-11 06:31:11	\N
524	KBUMmyHWxOjj27PjFVBGj7Vlq82Sy0mMvR7PuIgH	Guest	2026-02-11 08:55:17	2026-02-11 08:55:17	\N
525	qGUNhBAFP8KjCf7BAdqy2FYtWGhoCWHnHoTP1iYW	Guest	2026-02-11 16:14:28	2026-02-11 16:14:28	\N
526	C6AfWrmDUssd3Jq4HAIZBlHUrk7GTWhNhiBBIIGY	Guest	2026-02-11 20:35:57	2026-02-11 20:35:57	\N
527	bbXu5DySda4uSPBENnCrWSWpp7Twh2HTs9f16Cpx	Guest	2026-02-12 05:53:22	2026-02-12 05:53:22	\N
528	OxK2GdH3yMKxnhGVT7TtNPHIz53JaOAx3QZQPh2C	Guest	2026-02-12 06:49:09	2026-02-12 06:49:09	\N
529	Ec51XurQTFkZ1GqGiBMXoKyLmQI9j8fKUZe2xqWe	Guest	2026-02-12 12:32:35	2026-02-12 12:32:35	\N
530	87hae6xRteswG1uz9oe2Q8zdW4VrFBD1guB6tkHE	Guest	2026-02-13 00:40:21	2026-02-13 00:40:21	\N
531	hc1S1eqqqR3BhxP4g83NLHV3inEBF88rWa9E7NEF	Guest	2026-02-14 01:14:38	2026-02-14 01:14:38	\N
532	Z5vfWkHQloSskLpnkhJCbInyCy3g5G7VFtrVJDFN	Guest	2026-02-15 13:17:40	2026-02-15 13:17:40	\N
533	01oc9dMIEfqnHgJy0nEQAoU5hXUCYVlMqM07JopQ	Guest	2026-02-15 15:03:59	2026-02-15 15:03:59	\N
534	miQL9vJUZI6Cdu7XZuq7OYCPi0uB6QiW0HHWBrlY	Guest	2026-02-15 21:35:37	2026-02-15 21:35:37	\N
535	OpReFMbvplGpDqLytHtMCPVNgEkn2KyoPebr0jLq	Guest	2026-02-15 21:35:37	2026-02-15 21:35:37	\N
536	QJI1cqOMZVjg6mvXmpqcTpG0YrQKB5EM7eFkQSkW	Guest	2026-02-16 09:16:11	2026-02-16 09:16:11	\N
537	FZKbIN5PgkboP6uhZAeYOHshdfmax49PFxsUxCSi	Guest	2026-02-16 09:35:21	2026-02-16 09:35:21	\N
538	aLCnA0CfqKQtMnyusNx7Q87Jzv863ZLY5CWkbU4h	Guest	2026-02-16 15:49:46	2026-02-16 15:49:46	\N
539	k8kPFvQU2akI5UyC6OY7y5G26qzXvQCDJt4vVqA0	Guest	2026-02-16 19:02:50	2026-02-16 19:02:50	\N
540	3TsupiN6CEdKRDw3wexIVLsiNkUXJOotIBQKjy6H	Guest	2026-02-17 02:07:19	2026-02-17 02:07:19	\N
541	eCTmlqEdGcu2KukBOabIdC11RM2zWQQK9GElWTnL	Guest	2026-02-17 04:58:50	2026-02-17 04:58:50	\N
542	D4JtxjrUtTF0ifag82HoRd5sNXvFOVPOJ5sLvy0d	Guest	2026-02-17 08:52:19	2026-02-17 08:52:19	\N
543	5g04ilPGJcPSKvuzyH7CMIgyQABNqr4Db1zZhtZk	Guest	2026-02-17 09:07:11	2026-02-17 09:07:11	\N
544	cp4NKADthiHA5KLn4ZdeHIHGQNMEmTSI7XZXJRaS	Guest	2026-02-18 03:49:10	2026-02-18 03:49:10	\N
545	GPn5EMgPanTAudYQMhRhXAbEGod6FALNbBeoRodI	Guest	2026-02-18 04:10:10	2026-02-18 04:10:10	\N
546	dHhJ23Fh1iaiabPqE4nYSEh0S2UsEkUyup9VSVKU	Guest	2026-02-18 06:07:53	2026-02-18 06:07:53	\N
547	B2ien4r9mfgHGnCxk1MPpsEvR9UJCqbtrxhHQiZx	Guest	2026-02-18 20:57:33	2026-02-18 20:57:33	\N
548	MMJGFWd7N7XtF8K3YfwxULQmqO9O5oxmuw74Wwul	Guest	2026-02-19 00:41:39	2026-02-19 00:41:39	\N
549	YhcDdGGjP0EK4P9r3mcWL6zzNg1rw2TkokzI9k39	Guest	2026-02-19 03:14:06	2026-02-19 03:14:06	\N
550	ScCgA7pv2Xg8KuDKziQxFBXBrYkZluTl7TA3nr7q	Guest	2026-02-19 03:14:16	2026-02-19 03:14:16	\N
551	tk8q5hFs7MpmLvYuU7fimio8hy0T2uZBnwSi8KKt	Guest	2026-02-19 03:14:19	2026-02-19 03:14:19	\N
552	MeLKdUFYgF0xzt2F8w5tF9SrkPGjek6F3maUEW0G	Guest	2026-02-20 02:36:26	2026-02-20 02:36:26	\N
553	j2p4ir0CqWXDWoupIXGMY0lSs13afhWKG1VKt3O0	Guest	2026-02-20 03:00:32	2026-02-20 03:00:32	\N
554	U59lJiQ39UlsWEsog3GR4ftJuenWdLGolZduZRoM	Guest	2026-02-20 13:40:41	2026-02-20 13:40:41	\N
555	UuqlaVKO7GIKKH0IpAIY6pSkPKKkianMOAs4Ycka	Guest	2026-02-21 10:00:22	2026-02-21 10:00:22	\N
556	C11xrY2gTWaiTsGicVwMlgdOoHGwwAwl1JMejtb6	Guest	2026-02-21 13:44:43	2026-02-21 13:44:43	\N
557	t5ZZGvwDy6r94jwq5YvY0s23g5d1pDvevTsHoaEb	Guest	2026-02-21 16:38:22	2026-02-21 16:38:22	\N
558	AvE8rk65L7U7w9pe5Ag5HvRW8e5YxiPV665cHN95	Guest	2026-02-21 23:00:14	2026-02-21 23:00:14	\N
559	5clcRRCkgoWUCkW34WZB156uzT06wYOgfEdhB30N	Guest	2026-02-22 08:42:49	2026-02-22 08:42:49	\N
560	C3yKHfxqPxipDnAJDb8SkKsw8cdvAz94L3caOHbt	Guest	2026-02-22 09:09:52	2026-02-22 09:09:52	\N
561	AYT6gvOmrJgI0fL93jXhzC8lVI35PVreQ0wCtclL	Guest	2026-02-22 09:42:38	2026-02-22 09:42:38	\N
562	2xWsMJ1nFYbObeGHtEkz9t1T9jLDJrKTtjEVDOqI	Guest	2026-02-23 02:12:43	2026-02-23 02:12:43	\N
563	veveNwkh8B6Vf64ZXnm3TEKlUuzEViYHWQOIOgME	Guest	2026-02-23 03:32:54	2026-02-23 03:32:54	\N
564	VC8ESq9ThYEXOPhqO0ZJh4I6v8oxibEBUtwilnMk	Guest	2026-02-23 03:33:31	2026-02-23 03:33:31	\N
565	NLdSqmyz7yMdFklS3jmpdfU1zwLLKNv5cOkFsI41	Guest	2026-02-23 19:30:48	2026-02-23 19:30:48	\N
566	l0RtcIlqoTSC4cNNx6mJZnepsIgpT1DzTFzrDCP7	Guest	2026-02-24 03:44:22	2026-02-24 03:44:22	\N
567	iHXbQJWMYQqAqxBxNxWh565o58AuBXPhjXdDV74u	Guest	2026-02-24 05:31:00	2026-02-24 05:31:00	\N
568	WytflUtxVKoBLFAhuRgk5YeNXEWJFPBdtBF8NZ4d	Guest	2026-02-24 19:35:57	2026-02-24 19:35:57	\N
569	GtBz7iTk7rpkClQqh0ctNW2tclRzsYsHKww2xBto	Guest	2026-02-25 01:29:54	2026-02-25 01:29:54	\N
570	RLJYZo8g3H5SW6Hz9ZxXAT29vgt7LUogaAD8iqbo	Guest	2026-02-26 13:20:23	2026-02-26 13:20:23	\N
571	Ul4sr1IuO6wMsn9aXjEU6tjIEptincFnIceIiMQF	Guest	2026-02-26 21:25:54	2026-02-26 21:25:54	\N
572	7IF77ZJAdCDCwz9RYtx3Ub2W1JUP8cdso2U3cvme	Guest	2026-02-26 22:13:18	2026-02-26 22:13:18	\N
573	H5zKpZ6qV3jNzdfyUcQsMqLCKwXFifGgyWh3VoUp	Guest	2026-02-26 23:58:47	2026-02-26 23:58:47	\N
574	CS9XfADuhofWKBOKfTEjRmYABp60PS54Fz5Hd6ey	Guest	2026-02-27 02:40:36	2026-02-27 02:40:36	\N
575	Mdsj1lvOKtMhuAMbtA7zCt5lDcAqgn8A8uHPDI43	Guest	2026-02-27 04:00:17	2026-02-27 04:00:17	\N
576	7IQOV1dJnJzmJ9fXPM9M9UbFqohZE4ZX30yBCKCt	Guest	2026-02-27 04:00:32	2026-02-27 04:00:32	\N
577	MaaMATCKm0Qc1KXoULVc2XVe3Dc1owMlFqMHp0NP	Guest	2026-02-27 04:00:38	2026-02-27 04:00:38	\N
578	GCCBQMK46NicQwZW8wGrWZKHai12h3dTXJKrENEx	Guest	2026-02-27 08:53:37	2026-02-27 08:53:37	\N
579	Pf75ehcKuzAPBJfobvB24xTueYLIxuwFUptEdLHX	Guest	2026-02-27 08:53:50	2026-02-27 08:53:50	\N
580	zsr9RyS8lhLhknfdQXooXOh0FPB3Azr2gosFptmT	Guest	2026-02-27 16:34:43	2026-02-27 16:34:43	\N
581	w1jNiv9ZnLQF84jalqUXUzfr0ERTBFoc8ztOFU6p	Guest	2026-02-28 04:23:58	2026-02-28 04:23:58	\N
582	V04eijyOR6iVcYdZ64q1SbbXCbycsBTwcDOeWWat	Guest	2026-02-28 15:43:57	2026-02-28 15:43:57	\N
583	0A2LssL5Drk944GIID0lSXWv2lwJdsZsRzSL1xSQ	Guest	2026-03-01 11:03:56	2026-03-01 11:03:56	\N
584	ZShX2aV6SbtdCb1xjJtbGvwI83ILpy9AOphqndFu	Guest	2026-03-01 21:08:32	2026-03-01 21:08:32	\N
585	OARsKKXS1DkUGkN3ivjW6kd6GbfRRtis96WWW1I1	Guest	2026-03-02 09:46:57	2026-03-02 09:46:57	\N
586	PSBzKQtDMHqAaQx70KuFHyJuPT3hJyUag77IhQEn	Guest	2026-03-02 09:47:54	2026-03-02 09:47:54	\N
587	lqLoV46zkM7T0qORdbsiKaqyHMtm54wER8BWwoef	Guest	2026-03-02 11:35:10	2026-03-02 11:35:10	\N
588	0Gnv0bmMO4O9cCV1e03dQyLJLFbdYIy5jxhGJYLV	Guest	2026-03-02 17:08:50	2026-03-02 17:08:50	\N
589	repT7MqgBsNgslfxtIhGUNTIo3uo0UxXVI90oCiH	Guest	2026-03-02 20:15:55	2026-03-02 20:15:55	\N
590	rYrEwXjL9ihwheCxXdEHVxX9ztTgha79p3bVmtrs	Guest	2026-03-02 23:04:07	2026-03-02 23:04:07	\N
591	4Vdoe4v9SENbRpJtMzx0qDRWdQmAqtaAax6rah7G	Guest	2026-03-03 04:18:17	2026-03-03 04:18:17	\N
592	sdZGvHeGNamd4eFZXotpuZDViwiut2tzGxAxlXCx	Guest	2026-03-03 11:13:24	2026-03-03 11:13:24	\N
593	86g75h39UjXzFfTEzHRHcjqSopPu2f5YhiNqy9FO	Guest	2026-03-04 02:06:16	2026-03-04 02:06:16	\N
594	3em1B1rSC7MwJlbJFWjk2SA0U2VNTvNWMuBVUP5q	Guest	2026-03-04 03:10:45	2026-03-04 03:10:45	\N
595	cXGDlfD2mIf7XKclW0biek3W8oB2Mnt9g2aW9LbV	Guest	2026-03-04 03:39:52	2026-03-04 03:39:52	\N
596	AfVhhL3rxPwjGLtcan51sdG5Y1P6gHGRVwDEomJN	Guest	2026-03-04 03:43:32	2026-03-04 03:43:32	\N
597	nYcN0d2nTMVzxMQjUzY2ylaiBBuB8yJrAdUhcQsV	Guest	2026-03-04 04:05:01	2026-03-04 04:05:01	\N
598	FIJEnOdZZKyQgQcOy1H5f3eoN3vtT2Ie0Eff2v5I	Guest	2026-03-04 04:17:37	2026-03-04 04:17:37	\N
599	13lKG6muRLWliipCiLR4zOuhpGidFySccvB7TiXC	Guest	2026-03-04 04:18:21	2026-03-04 04:18:21	\N
600	WjA8T6BystAj7tN4TnhomSBCXPYBDD7fxPQM9ST9	Guest	2026-03-04 05:42:13	2026-03-04 05:42:13	\N
601	oGcls4e21wib5BoMyYF6MFgK6FQGOtSe9RJnYHiF	Guest	2026-03-04 08:39:08	2026-03-04 08:39:08	\N
602	SPUgAjb9ArZzOflsViFm440DcKekjfHms31qsneu	Guest	2026-03-04 14:10:23	2026-03-04 14:10:23	\N
603	yihIA75IR2XMJxkrJPiw94Js4IPWA9oVxlyQjnJh	Guest	2026-03-04 14:18:58	2026-03-04 14:18:58	\N
604	C1FRbOhStg2ggJ9ic06g5jOIxHMdtvfTGUnNYy6Z	Guest	2026-03-04 16:17:08	2026-03-04 16:17:08	\N
605	trkhOAhpwY2tVmOEFWOdBz38xlwNagkyqQ71tef7	Guest	2026-03-05 10:23:16	2026-03-05 10:23:16	\N
606	y6VKT4WfvNRtiA27nrnl9cPxHm8nWbRlDc24EyGg	Guest	2026-03-05 12:23:59	2026-03-05 12:23:59	\N
607	SlI7R2I50vskrvotjajHRBXmx3Nn7KbVZ2MLFEhL	Guest	2026-03-05 12:34:38	2026-03-05 12:34:38	\N
608	22WUiQTnkt6oE235j3MvJEfoRqQQ5lKT2ail23Jr	Guest	2026-03-05 12:34:42	2026-03-05 12:34:42	\N
609	hIOBTEy4cv0z5sRDYCRp14RWeSDlqPbHm17paHKX	Guest	2026-03-05 13:44:05	2026-03-05 13:44:05	\N
610	hVXSZJzsyoKpDDpZwANdASruMy6HUvV9snlYBmZc	Guest	2026-03-05 13:44:16	2026-03-05 13:44:16	\N
611	AI9S8g4TSDtbmINZRIdOugFrKLf8e41EHt5X2jxU	Guest	2026-03-05 13:44:20	2026-03-05 13:44:20	\N
612	xOsanUBN9YkOcciNonz82SXfUC8AUHMSCTysZl4f	Guest	2026-03-05 14:10:31	2026-03-05 14:10:31	\N
613	NDF8lslqARC8kRh2swKAeSwgTuuKsRACiortmgxc	Guest	2026-03-06 14:30:46	2026-03-06 14:30:46	\N
614	LTYfivyIUhq90gmP03XN8g9NzfLnWC5JOu4DaWXy	Guest	2026-03-06 15:22:45	2026-03-06 15:22:45	\N
615	BAzFdYamlezEyNINJLZwQhhcpXOYz0GxI4YTcwqo	Guest	2026-03-08 07:42:35	2026-03-08 07:42:35	\N
616	0mUI96dr3HMavID6xjLHyZsObjZWmWhg3j85mFni	Guest	2026-03-09 07:19:12	2026-03-09 07:19:12	\N
617	wS4WDIXOqHwipVvXuwNCw9fNKtk0JR95eeE67Gt8	Guest	2026-03-09 14:07:16	2026-03-09 14:07:16	\N
618	kxVsVYek9ZWZiBxsmgIQzqcsPBH2n0kPOLWepyRt	Guest	2026-03-09 22:54:12	2026-03-09 22:54:12	\N
619	JMSRmCPWmcx6FKBgB1f7nUoobDJlladnauHc5pci	Guest	2026-03-09 22:54:27	2026-03-09 22:54:27	\N
620	C04ysb2lqCnHwhTjnP1Hm7CdwJFLesl7PJILxrXG	Guest	2026-03-09 22:54:28	2026-03-09 22:54:28	\N
621	B7hNR7wyBYSwhQ3hwykuJQSLnr8w8FiHvlLC195L	Guest	2026-03-10 06:42:27	2026-03-10 06:42:27	\N
622	RbIEdygGJ7J4YcyBkerNBMVcqgVSwHLi95Do9mtF	Guest	2026-03-10 07:01:45	2026-03-10 07:01:45	\N
623	JWFy4S3QrkfIJF9ZpIZ3IaU8oWkN93sUbeWiXjho	Guest	2026-03-10 13:44:42	2026-03-10 13:44:42	\N
624	1icESBdwGjoOEIs81EvkO0KOIBUyruR2pysQ1zqT	Guest	2026-03-10 14:43:01	2026-03-10 14:43:01	\N
625	ebtyLCZxY5ptoegbuLNDW3mXPd5RKZacziUR8szY	Guest	2026-03-11 03:42:28	2026-03-11 03:42:28	\N
626	b67GmSVUQQMvyy9phDdRL51oX87ZSOAdnMNufLib	Guest	2026-03-11 14:13:04	2026-03-11 14:13:04	\N
627	1xYYv4YginWwdSJmGTuh1hm3hZ4bhgp9APSLRIb8	Guest	2026-03-11 20:04:28	2026-03-11 20:04:28	\N
628	Vz9i1A7Ykr3sUWFeBHyzQP9wYTJ2Gdq07B4guqk0	Guest	2026-03-12 04:04:04	2026-03-12 04:04:04	\N
629	ku9WGTPKfmcAqTt7PCKpfJOiQwGtM5Dfr2YUeKtk	Guest	2026-03-12 04:04:10	2026-03-12 04:04:10	\N
630	1fXVF3jwbTH59rhKUmpHkW4LqDgI4RF2tVObJVzg	Guest	2026-03-12 04:12:21	2026-03-12 04:12:21	\N
631	WXY52DUs8kXJyj3sVeRR7fa3ZayXbIoejYtCjhyN	Guest	2026-03-12 08:04:09	2026-03-12 08:04:09	\N
632	TUVrsp2cTThE7ZcHDbHo9lhQJ3S7d5spR4E25PEL	Guest	2026-03-12 15:08:43	2026-03-12 15:08:43	\N
633	PkCChTbzDDCJLPeGNlxWmxVEMOQ556UyI82zfW02	Guest	2026-03-12 17:38:53	2026-03-12 17:38:53	\N
634	wJBggZMBZDbpB0BCvP6aG25gUkk4ZBAkDtqgzEKJ	Guest	2026-03-12 18:53:42	2026-03-12 18:53:42	\N
635	ZgXjd2yfwQ8qH1thzJ3SagAomaLB1PfsAwlXD0ih	Guest	2026-03-12 19:09:59	2026-03-12 19:09:59	\N
636	puT1KmsmDcXfZHu8KYjNFM6vTwEradGbs5vB2O8A	Guest	2026-03-13 02:33:39	2026-03-13 02:33:39	\N
637	njQ6egJBeyLgkaz4Yiv7YTLUg3LpHkXzeVjlR68u	Guest	2026-03-13 03:00:17	2026-03-13 03:00:17	\N
638	xsk9h45dVB3CEeIP5wz3UeBrViJhlQLLTRN32Hi7	Guest	2026-03-13 11:56:27	2026-03-13 11:56:27	\N
\.


--
-- Data for Name: chatbot_knowledges; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chatbot_knowledges (id, topic, intent_name, keywords, response, created_at, updated_at) FROM stdin;
1	Tentang Perusahaan	about_futurecloud	["siapa","apa itu futurecloud","profil","perusahaan","tentang","future cloud"]	FutureCloud adalah penyedia layanan infrastruktur komputasi awan (Cloud), pendaftaran Domain, VPS (Virtual Private Server), Web Hosting, serta pengembangan perangkat lunak SaaS terkemuka di Indonesia. Kami berfokus pada kecepatan, keamanan, dan keandalan server untuk mendukung bisnis go-digital.	2026-08-14 21:02:08	2026-08-14 21:02:08
2	Layanan Utama	main_services	["layanan","jasa","produk apa saja","menyediakan apa","bisa buat","jual apa"]	Kami menyediakan 4 layanan utama: 1) Pendaftaran & Transfer Domain (.com, .id, dll). 2) Cloud VPS berkinerja tinggi. 3) Managed Web Hosting & cPanel. 4) Layanan SaaS (Software as a Service) dan pembuatan website / aplikasi custom sesuai pesanan.	2026-08-14 21:02:08	2026-08-14 21:02:08
3	Keunggulan / Benefit	benefits	["keunggulan","kelebihan","kenapa harus","benefit","bedanya","alasan"]	Keunggulan FutureCloud: 1) Uptime 99.9% dijamin SLA. 2) Bantuan teknis (Support) 24/7. 3) Server dengan penyimpanan NVMe SSD yang sangat cepat. 4) Integrasi pendaftaran domain instan tanpa ribet.	2026-08-14 21:02:08	2026-08-14 21:02:08
4	Proses Aktivasi (Domain & VPS)	activation_process	["berapa lama","aktivasi","aktifnya kapan","proses pendaftaran","setelah bayar"]	Aktivasi layanan di FutureCloud sepenuhnya otomatis! Setelah pembayaran Anda terkonfirmasi sukses, Domain akan langsung terdaftar secara realtime dan VPS/Hosting Anda akan langsung aktif dalam hitungan menit.	2026-08-14 21:02:08	2026-08-14 21:02:08
5	Metode Pembayaran	payment_methods	["bayar pakai apa","cara bayar","pembayaran","transfer","qris","rekening"]	Anda bisa melakukan pembayaran melalui Transfer Bank Virtual Account (BCA, BNI, Mandiri, BRI), QRIS, maupun E-Wallet (OVO, Dana, GoPay). Proses konfirmasi pembayaran dilakukan secara otomatis oleh sistem.	2026-08-14 21:02:08	2026-08-14 21:02:08
6	Kebijakan Pengembalian Dana (Refund)	refund_policy	["refund","garansi uang kembali","pengembalian dana","batal","uang kembali"]	Kami memberikan Garansi Uang Kembali 30 Hari untuk layanan Hosting (syarat & ketentuan berlaku). Namun, untuk pendaftaran nama domain, biaya tidak dapat di-refund karena domain yang sudah didaftarkan tidak dapat dibatalkan.	2026-08-14 21:02:08	2026-08-14 21:02:08
7	Kontak Support & Lokasi	contact_info	["alamat","lokasi","kantor","hubungi","whatsapp","email","nomor telepon"]	Anda dapat menghubungi tim bantuan kami melalui Live Chat di website, Email ke support@futurecloud.id, atau melalui Sistem Tiket di Client Area. Kantor pusat kami berlokasi di Jakarta, Indonesia.	2026-08-14 21:02:08	2026-08-14 21:02:08
8	Pendaftaran Akun Baru	register_account	["cara daftar","bikin akun","register","buat akun baru"]	Untuk mulai berlangganan, Anda cukup mengklik tombol "Daftar" atau "Client Area" di pojok kanan atas website kami, lalu isi data diri Anda. Pendaftaran 100% gratis tanpa biaya bulanan untuk akun.	2026-08-14 21:02:08	2026-08-14 21:02:08
9	Panduan Transfer Domain	transfer_domain	["transfer domain","pindah domain","pindahkan domain","migrasi domain"]	Tentu bisa! Anda dapat mentransfer domain Anda dari provider lama ke FutureCloud. Pastikan domain Anda sudah dibuka kuncinya (Unlock) di provider lama dan Anda memiliki kode EPP (Auth Code).	2026-08-14 21:02:08	2026-08-14 21:02:08
10	Layanan SaaS	saas_info	["saas","aplikasi jadi","bikin aplikasi","pesan website","custom app"]	Layanan SaaS (Software as a Service) kami menawarkan berbagai aplikasi siap pakai seperti Sistem ERP, Aplikasi POS/Kasir, dan Web Company Profile. Kami juga melayani pembuatan aplikasi kustom (Custom Development) sesuai alur bisnis Anda.	2026-08-14 21:02:08	2026-08-14 21:02:08
\.


--
-- Data for Name: chatbot_leads; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chatbot_leads (id, user_id, ip_address, topic_context, contact_info, chat_history, last_message, status, created_at, updated_at, live_chat_status, admin_id) FROM stdin;
1	\N	114.10.144.198	Umum	-	[{"sender":"user","message":"halo","time":"20:50"}]	halo	pending	2026-03-13 13:50:49	2026-03-13 13:50:49	none	\N
2	\N	114.10.144.198	Domain & SSL	Guest - 114.10.144.198	[{"sender":"user","text":"Memilih topik: Layanan Cloud","time":"21:00"},{"sender":"bot","text":"Baik, ada yang bisa saya bantu mengenai **Layanan Cloud**?","time":"21:00"},{"sender":"user","text":"bagaiaman caranya","time":"21:01"},{"sender":"bot","text":"Maaf, pertanyaan Kakak kurang jelas untuk topik **Layanan Cloud**. Boleh dijelaskan dengan kata kunci yang lebih spesifik?","time":"21:01"},{"sender":"user","text":"Memilih topik: Domain & SSL","time":"21:01"},{"sender":"bot","text":"Baik, ada yang bisa saya bantu mengenai **Domain & SSL**?","time":"21:01"},{"sender":"user","text":"bagaimana cara membeli domain","time":"21:01"},{"sender":"bot","text":"Maaf, pertanyaan Kakak kurang jelas untuk topik **Domain & SSL**. Boleh dijelaskan dengan kata kunci yang lebih spesifik?","time":"21:01"},{"sender":"user","text":"Akhiri & Hubungi CS","time":"21:01"}]	Akhiri & Hubungi CS	contacted	2026-03-13 14:00:55	2026-03-13 14:01:38	none	\N
3	\N	114.10.149.198	Akun	ghryshvi@gmail.com	[{"sender":"user","text":"Topik dipilih: Akun","time":"21:23"},{"sender":"bot","text":"Baik, ada yang bisa Mimin bantu mengenai Akun?","time":"21:23"},{"sender":"user","text":"bagaimana cara login","time":"21:23"},{"sender":"bot","text":"Silakan <a href=\\"\\/login\\" class=\\"font-bold text-blue-600\\">Klik Disini untuk Login<\\/a>. Jika lupa password, gunakan fitur \\"Forgot Password\\" di halaman login ya.","time":"21:23"},{"sender":"user","text":"Akhiri & Hubungi CS","time":"21:23"},{"sender":"bot","text":"Baik Kak, percakapan ini akan kami teruskan ke Customer Service. Silakan ketik Email atau Nomor Telepon Kakak di bawah agar bisa kami hubungi secepatnya:","time":"21:23"},{"sender":"user","text":"ghryshvi@gmail.com","time":"21:23"}]	ghryshvi@gmail.com	pending	2026-03-13 14:23:06	2026-03-13 14:23:37	none	\N
4	\N	182.253.150.3	Billing	\N	[{"sender":"user","text":"Topik dipilih: Billing","time":"17:08"}]	Memilih topik: Billing	pending	2026-03-17 10:14:29	2026-03-17 10:14:29	none	\N
5	\N	114.10.7.218	Client Area	\N	[{"sender":"user","text":"Topik dipilih: Umum","time":"13:19"},{"sender":"bot","text":"Baik, ada yang bisa Mimin bantu mengenai Umum?","time":"13:19"},{"sender":"user","text":"Tolong jelaskan tentang future cloud","time":"13:19"},{"sender":"bot","text":"Maaf, pertanyaan Kakak kurang jelas. Boleh dijelaskan dengan kata kunci yang lebih spesifik?","time":"13:19"},{"sender":"user","text":"Topik dipilih: Client Area","time":"13:19"},{"sender":"bot","text":"Baik, ada yang bisa Mimin bantu mengenai Client Area?","time":"13:19"},{"sender":"user","text":"Apa itu client area?","time":"13:19"}]	Apa itu client area?	pending	2026-04-06 06:19:08	2026-04-06 06:20:00	none	\N
16	1	82.158.131.175	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"14 Agu, 17.17"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"14 Agu, 17.17"},{"sender":"user","text":"domain paling murah apa ya","time":"14 Agu, 17.17"}]	domain paling murah apa ya	pending	2026-08-14 17:17:29	2026-08-14 17:17:39	none	\N
6	\N	114.79.1.57	Layanan	\N	[{"sender":"user","text":"Topik dipilih: Layanan","time":"12:09"},{"sender":"bot","text":"Baik, ada yang bisa Mimin bantu mengenai Layanan?","time":"12:09"},{"sender":"user","text":"Perbedaan vps hosting dengan vps server itu apa ya ?","time":"12:09"},{"sender":"bot","text":"Maaf, jaringan sedang bermasalah.","time":"12:09"},{"sender":"user","text":"Perbedaan vps hosting dengan vps server itu apa ya ?","time":"12:10"}]	Perbedaan vps hosting dengan vps server itu apa ya ?	pending	2026-04-10 05:09:19	2026-04-10 05:10:53	none	\N
7	\N	172.18.0.1	Billing	\N	[{"sender":"user","text":"Topik dipilih: Billing","time":"10:32"}]	Memilih topik: Billing	pending	2026-06-03 03:32:19	2026-06-03 03:32:19	none	\N
8	12	172.18.0.1	Partner	\N	[{"sender":"user","text":"Topik dipilih: Partner","time":"11:52"},{"sender":"bot","text":"Baik, ada yang bisa Mimin bantu mengenai Partner?","time":"11:52"},{"sender":"user","text":"Topik dipilih: Akun","time":"11:52"},{"sender":"bot","text":"Baik, ada yang bisa Mimin bantu mengenai Akun?","time":"11:52"},{"sender":"user","text":"apakah ada bug di website ini??","time":"11:53"},{"sender":"bot","text":"Maaf, pertanyaan Kakak kurang jelas. Boleh dijelaskan dengan kata kunci yang lebih spesifik?","time":"11:53"},{"sender":"user","text":"Topik dipilih: Partner","time":"11:53"}]	Memilih topik: Partner	pending	2026-06-03 04:52:40	2026-06-03 04:53:17	none	\N
9	19	172.18.0.1	Billing	\N	[{"sender":"user","text":"Topik dipilih: Billing","time":"15:07"}]	Memilih topik: Billing	pending	2026-06-03 08:07:39	2026-06-03 08:07:39	none	\N
10	22	103.18.34.207	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"10 Agu, 16.01"}]	halo	pending	2026-08-10 16:01:51	2026-08-10 16:01:51	none	\N
11	22	103.18.34.207	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"10 Agu, 16.02"}]	halo	pending	2026-08-10 16:02:37	2026-08-10 16:02:37	none	\N
12	22	103.18.34.207	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"10 Agu, 16.06"}]	halo	pending	2026-08-10 16:06:05	2026-08-10 16:06:05	none	\N
13	22	103.18.34.207	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"10 Agu, 16.07"}]	halo	pending	2026-08-10 16:07:05	2026-08-10 16:07:05	none	\N
14	\N	103.36.8.105	Live Chat	Diakhiri Otomatis (Guest)	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"bot","text":"Meneruskan permintaan ke tim Live Chat. Mohon tunggu sebentar..."},{"sender":"bot","text":"Sesi chat telah diakhiri otomatis oleh sistem karena tidak ada aktivitas."}]	Meminta Live Chat	pending	2026-08-12 20:08:52	2026-08-12 20:36:07	none	\N
17	1	82.158.131.175	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"apa itu futurecloud?","time":"14 Agu, 21.02"},{"sender":"bot","text":"Halo Kak! AI kami sedang sibuk kak. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat.","time":"14 Agu, 21.02"},{"sender":"user","text":"apa itu futurecloud?","time":"14 Agu, 21.02"},{"sender":"bot","text":"Halo Kak! AI kami sedang sibuk kak. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat.","time":"14 Agu, 21.02"},{"sender":"user","text":"apa itu futurecloud?","time":"14 Agu, 21.03"}]	apa itu futurecloud?	pending	2026-08-14 21:02:46	2026-08-14 21:03:02	none	\N
15	\N	103.36.8.105	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"Hai KA, ada WA GK ya.. atau ada IG nya","time":"12 Agu, 20.37"},{"sender":"bot","text":"Halo Kak! Halo {name}! \\ud83e\\udd16 Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain<\\/b>, info <b>VPS<\\/b>, atau cara akses <b>Client Area<\\/b>. Mau tanya apa hari ini?","time":"12 Agu, 20.37"},{"sender":"user","text":"Mau bantu di buatkan stiker timbul ka untuk di gerobak dagangan saya","time":"12 Agu, 20.38"},{"sender":"bot","text":"Halo Kak! Untuk melihat layanan aktif atau langganan Anda, silakan masuk ke <a href=\\"\\/client-area\\" class=\\"text-blue-600 underline font-bold\\">Client Area<\\/a>. <br>Di sana Anda bisa mengelola VPS, Hosting, dan SaaS yang sudah dibeli.","time":"12 Agu, 20.38"},{"sender":"user","text":"Gak bisa di klik ya","time":"12 Agu, 20.39"}]	Gak bisa di klik ya	pending	2026-08-12 20:37:24	2026-08-12 20:39:01	none	\N
18	1	82.158.131.175	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"apa itu futurecloud?","time":"14 Agu, 21.14"},{"sender":"bot","text":"Halo Kak! AI kami sedang sibuk kak. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat.","time":"14 Agu, 21.14"},{"sender":"user","text":"hallo","time":"14 Agu, 21.14"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"14 Agu, 21.14"},{"sender":"user","text":"apa itu futurecloud?","time":"14 Agu, 21.14"},{"sender":"bot","text":"Halo Kak! AI kami sedang sibuk kak. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat.","time":"14 Agu, 21.14"},{"sender":"user","text":"apa itu futurecloud","time":"14 Agu, 21.20"}]	apa itu futurecloud	pending	2026-08-14 21:14:33	2026-08-14 21:20:33	none	\N
19	1	82.158.131.175	Umum	gispi.desu@gmail.com	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"14 Agu, 21.20"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"14 Agu, 21.20"},{"sender":"user","text":"hai","time":"14 Agu, 21.20"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"14 Agu, 21.20"},{"sender":"bot","text":"Bot perhatikan tidak ada balasan cukup lama. Apakah Anda masih di sana? Sesi ini akan otomatis diakhiri dalam 5 menit."},{"sender":"bot","text":"Sesi chat telah diakhiri otomatis oleh sistem karena tidak ada aktivitas."}]	hai	pending	2026-08-14 21:20:43	2026-08-14 21:36:27	none	\N
20	1	82.158.131.175	Umum	gispi.desu@gmail.com	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"apa itu futurecloud","time":"14 Agu, 21.50"},{"sender":"bot","text":"Halo Kak! AI kami sedang sibuk kak. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat.","time":"14 Agu, 21.50"},{"sender":"bot","text":"Sesi chat telah diakhiri otomatis oleh sistem karena tidak ada aktivitas."}]	apa itu futurecloud	pending	2026-08-14 21:50:11	2026-08-14 22:11:40	none	\N
21	\N	82.158.131.175	Umum	Diakhiri Otomatis (Guest)	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"14 Agu, 22.04"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"14 Agu, 22.04"},{"sender":"user","text":"apa itu futurecloud?","time":"14 Agu, 22.04"},{"sender":"bot","text":"Halo Kak! AI kami sedang sibuk kak. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat.","time":"14 Agu, 22.04"},{"sender":"bot","text":"Sesi chat telah diakhiri otomatis oleh sistem karena tidak ada aktivitas."}]	apa itu futurecloud?	pending	2026-08-14 22:04:21	2026-08-17 18:52:47	none	\N
22	\N	103.147.8.19	Umum	Diakhiri Otomatis (Guest)	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"17 Agu, 18.53"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"17 Agu, 18.53"},{"sender":"user","text":"futurecloud itu apa sih","time":"17 Agu, 18.53"},{"sender":"bot","text":"Halo Kak! \\ud83d\\ude0a AI kami sedang dalam proses restart. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat untuk info lebih cepat!","time":"17 Agu, 18.53"},{"sender":"user","text":"halo kak","time":"17 Agu, 18.54"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"17 Agu, 18.54"},{"sender":"user","text":"futurecloud itu apa ya?","time":"17 Agu, 18.54"},{"sender":"bot","text":"Halo Kak! \\ud83d\\ude0a AI kami sedang dalam proses restart. Silakan cek detail produk langsung di halaman utama ya, atau hubungi Live Chat untuk info lebih cepat!","time":"17 Agu, 18.54"},{"sender":"bot","text":"Bot perhatikan tidak ada balasan cukup lama. Apakah Anda masih di sana? Sesi ini akan otomatis diakhiri dalam 5 menit."},{"sender":"bot","text":"Sesi chat telah diakhiri otomatis oleh sistem karena tidak ada aktivitas."}]	futurecloud itu apa ya?	pending	2026-08-17 18:53:07	2026-08-17 19:09:29	none	\N
23	\N	103.147.8.19	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"17 Agu, 19.15"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"17 Agu, 19.15"},{"sender":"user","text":"futurecloud itu apa sih","time":"17 Agu, 19.15"}]	futurecloud itu apa sih	pending	2026-08-17 19:15:09	2026-08-17 19:15:15	none	\N
24	\N	103.147.8.19	Umum	Diakhiri Otomatis (Guest)	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"halo","time":"17 Agu, 19.19"},{"sender":"bot","text":"Halo Kak! \\ud83d\\udc4b Ada yang bisa dibantu terkait Futurecloud?","time":"17 Agu, 19.19"},{"sender":"user","text":"futurecloud itu apa sih","time":"17 Agu, 19.19"},{"sender":"bot","text":"Maaf, sedang gangguan jaringan. Coba lagi ya."},{"sender":"user","text":"futurecloud itu apa sih","time":"17 Agu, 19.23"},{"sender":"bot","text":"FutureCloud adalah layanan cloud hosting yang menyediakan berbagai domain pilihan untuk bisnis kamu! <br \\/>\\n<br \\/>\\nKamu bisa memilih dari beragam jenis domain seperti .CO.UK, .NET, .XXX, dan masih banyak lagi dengan harga yang bervariasi.  Setiap domain memiliki fitur standarnya sendiri. Ada juga beberapa domain khusus seperti .US.ORG, .FOREX, dan lain-lain.<br \\/>\\n<br \\/>\\nUntuk informasi lebih lanjut tentang layanan FutureCloud, silakan klik tombol Live Chat CS di situs web kami!","time":"17 Agu, 19.23"},{"sender":"bot","text":"Bot perhatikan tidak ada balasan cukup lama. Apakah Anda masih di sana? Sesi ini akan otomatis diakhiri dalam 5 menit."},{"sender":"bot","text":"Sesi chat telah diakhiri otomatis oleh sistem karena tidak ada aktivitas."}]	futurecloud itu apa sih	pending	2026-08-17 19:19:21	2026-08-17 19:38:27	none	\N
25	10	140.213.98.64	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"berapa harga domain .com di futurecloud?","time":"1 Sep, 15.38"},{"sender":"bot","text":"Untuk mendapatkan informasi lebih detail tentang harga domain .COM FutureCloud, kami menyarankan Anda menghubungi tim pemesanan langsung melalui live chat atau kontak yang telah disediakan untuk memastikan kebutuhan spesifik Anda. Pastikan juga bahwa produk tersebut sesuai dengan tujuan bisnis dan strategi marketing Anda.","time":"1 Sep, 15.38"},{"sender":"user","text":"ada berapa domain yang dijual oleh futurecloud","time":"1 Sep, 15.41"}]	ada berapa domain yang dijual oleh futurecloud	pending	2026-09-01 15:38:48	2026-09-01 15:41:26	none	\N
26	10	140.213.24.223	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"berapa harga domain .com di futurecloud?","time":"1 Sep, 15.50"}]	berapa harga domain .com di futurecloud?	pending	2026-09-01 15:50:38	2026-09-01 15:50:38	none	\N
27	10	140.213.24.223	Umum	-	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"berapa harga domain .com di futurecloud?","time":"1 Sep, 15.53"}]	berapa harga domain .com di futurecloud?	pending	2026-09-01 15:53:57	2026-09-01 15:53:57	none	\N
28	10	140.213.98.64	Umum	info@dny-filterindo.co.id	[{"sender":"bot","text":"Halo \\ud83d\\udc4b! Selamat datang di pusat bantuan Futurecloud. Ada yang bisa kami bantu hari ini?"},{"sender":"user","text":"berapa harga domain .com di futurecloud?","time":"1 Sep, 15.58"},{"sender":"bot","text":"harga domain .COM pada saat ini adalah 205,000 rupiah untuk satu tahun dan dapat diperbarui dengan biaya tambahan sebesar 166.000 rupiah jika Anda memilih opsi \\"Off 1st Year\\".","time":"1 Sep, 15.58"},{"sender":"bot","text":"Bot perhatikan tidak ada balasan cukup lama. Apakah Anda masih di sana? Sesi ini akan otomatis diakhiri dalam 5 menit."},{"sender":"bot","text":"Sesi chat telah diakhiri otomatis oleh sistem karena tidak ada aktivitas."}]	berapa harga domain .com di futurecloud?	pending	2026-09-01 15:58:11	2026-09-01 16:14:12	none	\N
\.


--
-- Data for Name: chatbot_responses; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chatbot_responses (id, keyword, answer, created_at, updated_at) FROM stdin;
2	siapa kamu, bot, robot	Saya asisten pintar FutureCloud ??. Saya ada di sini untuk membantu Anda mengelola layanan cloud dan bisnis SaaS Anda.	2025-12-09 05:18:40	2025-12-09 05:18:40
3	client area, dashboard, langganan, subscription, paket saya, login area	Untuk melihat layanan aktif atau langganan Anda, silakan masuk ke <a href="/client-area" class="text-blue-600 underline font-bold">Client Area</a>. <br>Di sana Anda bisa mengelola VPS, Hosting, dan SaaS yang sudah dibeli.	2025-12-09 05:18:40	2025-12-09 05:18:40
4	cek tagihan, bayar tagihan, invoice, billing	Tagihan Anda dapat dilihat dan dibayar melalui menu <b>Billing</b> di dalam <a href="/client-area/invoices" class="text-blue-600 underline font-bold">Client Area</a>. Kami menerima QRIS, VA Bank, dan E-Wallet.	2025-12-09 05:18:40	2025-12-09 05:18:40
5	partner, jadi partner, jual aplikasi, vendor, mitra	Ingin dapat penghasilan tambahan? ??<br>Bergabunglah menjadi Partner FutureCloud! Anda bisa menjual aplikasi SaaS buatan Anda di marketplace kami. <br><a href="/partner/register" class="bg-blue-600 text-white px-3 py-1 rounded text-xs mt-2 inline-block">Daftar Jadi Partner</a>	2025-12-09 05:18:40	2025-12-09 05:18:40
6	syarat partner, keuntungan partner, komisi	Sebagai Partner, Anda mendapatkan dashboard vendor khusus dan komisi hingga 70% dari setiap penjualan. Pastikan aplikasi Anda siap pakai (SaaS based).	2025-12-09 05:18:40	2025-12-09 05:18:40
7	vps, virtual server, harga vps, beli server	VPS kami menggunakan NVMe SSD super cepat! ??<br>Mulai dari <b>Rp 100rb/bln</b> (2 Core, 4GB RAM). <br><a href="/services/vps" class="text-blue-600 underline">Lihat Paket VPS</a>	2025-12-09 05:18:40	2025-12-09 05:18:40
8	domain, beli domain, cek domain, harga domain	Amankan nama brand Anda sekarang! ??<br><b>.COM</b> cuma Rp 150rb/thn.<br><b>.ID</b> cuma Rp 200rb/thn.<br>Cek ketersediaan di halaman <a href="/domain" class="text-blue-600 underline">Domain Checker</a>.	2025-12-09 05:18:40	2025-12-09 05:18:40
9	cpanel, hosting cpanel	Layanan Hosting kami sudah include lisensi <b>cPanel</b> resmi. Mudah kelola file, email, dan database. Cocok untuk pemula maupun pro.	2025-12-09 05:18:40	2025-12-09 05:18:40
10	aplikasi, saas, software, marketplace	Kami punya marketplace aplikasi bisnis siap pakai. Mulai dari HRIS, Kasir, hingga Manajemen Proyek. Cek katalognya di <a href="/marketplace" class="text-blue-600 underline">SaaS Marketplace</a>.	2025-12-09 05:18:40	2025-12-09 05:18:40
11	login, masuk, sign in, gagal login	Silakan <a href="/login" class="font-bold text-blue-600">Klik Disini untuk Login</a>. Jika lupa password, gunakan fitur "Forgot Password" di halaman login ya.	2025-12-09 05:18:40	2025-12-09 05:18:40
12	register, daftar, buat akun	Belum punya akun? Pendaftaran gratis kok! <a href="/register" class="font-bold text-blue-600">Daftar Sekarang</a> untuk mulai belanja layanan cloud.	2025-12-09 05:18:40	2025-12-09 05:18:40
1	halo, hi, hai, selamat, pagi, siang, malam, hello	Halo {name}! Selamat datang di FutureCloud.id. <br>Saya bisa bantu cek <b>Domain</b>, info <b>VPS</b>, atau cara akses <b>Client Area</b>. Mau tanya apa hari ini?	2025-12-09 05:18:40	2025-12-09 06:15:24
\.


--
-- Data for Name: email_accounts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.email_accounts (id, email, email_password, imap_host, imap_port, imap_encryption, imap_protocol, imap_validate_cert, smtp_host, smtp_port, smtp_encryption, is_active, created_at, updated_at) FROM stdin;
1	arifin@futurecloud.id	eyJpdiI6IlRFUUZmc1ZubEljWTJIVFVmWGcwZEE9PSIsInZhbHVlIjoiNzdMdTJ0ajM3bThCVW12Z2Robyttdz09IiwibWFjIjoiNjZkNmQ1YjNlNGIxYzAxMDAzNzQxZGU2NzVlN2M4NmFiZWI1OWJkNGY2OGQ3NjQ4ZmQyYjIyOGI2NGI3YTk1ZiIsInRhZyI6IiJ9	mail.futurecloud.id	993	ssl	imap	f	mail.futurecloud.id	465	ssl	t	2026-05-19 04:54:24	2026-05-19 04:54:24
2	syalpra@futurecloud.id	eyJpdiI6IkY5Z2RRM2pCUFBmTmpYV0IwdHJ3UkE9PSIsInZhbHVlIjoiNS9DTnVWQUtPbVdjSnRGQ2ZaMzhSUT09IiwibWFjIjoiNmM1YjdmMjc5ZGIzYmMxMDY4ZjNjNGI0NjYwMTJlNmZiOGQ0NzcwNDU3MjU4ZDYxOTJkMjM2YWI0OTk1YThmYiIsInRhZyI6IiJ9	mail.futurecloud.id	993	ssl	imap	f	mail.futurecloud.id	465	ssl	t	2026-05-19 06:54:06	2026-05-19 06:54:06
3	ghryshvi@futurecloud.id	eyJpdiI6ImNVK2ozaEVubGpzTXMrYTdrNHJOeWc9PSIsInZhbHVlIjoiUG5rSXFMUi90TG0zMXh6V3d5MHN4Y0lyUkExRmtBUDdYYUpDTW9UUFdLOD0iLCJtYWMiOiIwNDdhZWRjYWViZTcyOTFmMmEyYzQwNWU2MzljMjlkMmNkZjg5MzdiZTc0YjgyMTczMDBkZGM1ZTg3YzRkYWRhIiwidGFnIjoiIn0=	mail.futurecloud.id	993	ssl	imap	f	mail.futurecloud.id	465	ssl	t	2026-05-19 06:54:07	2026-05-19 06:54:07
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: helpdesk_users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.helpdesk_users (id, user_id, license_key, name, email, password, avatar, is_active, last_login_at, created_at, updated_at) FROM stdin;
6	9	FC-LIC-0056-I4HAF2	Ghrysh	ghryshvi.dzickra@gmail.com	$2y$12$Cak4mhYxVELvJvK1zES7F.ozI1BCx4kpcqHuCDYvgUsC21Cn.OHpG	\N	t	2026-08-13 12:15:19	2026-08-12 21:53:22	2026-08-13 12:15:19
\.


--
-- Data for Name: hero_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.hero_settings (id, tagline, title, subtitle, background_images, created_at, updated_at, promo_image, promo_url, is_promo_active) FROM stdin;
1	\N	\N	\N	["assets\\/bg.webp","hero\\/kyJJF31sWC6vxxnNMPGthurhxPUM5EFbKbUXvOPS.webp"]	2025-12-09 11:18:33	2026-08-14 20:25:07	promo/BqyufQOPfJVHm44O8em3LG30ozXmuXDMdLaDNmls.webp	https://www.futurecloud.id/domain-registration	t
\.


--
-- Data for Name: invoices; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.invoices (id, user_id, invoice_no, description, amount, status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	0001_01_01_000000_create_users_table	1
2	0001_01_01_000001_create_cache_table	1
3	0001_01_01_000002_create_jobs_table	1
4	2025_11_27_044533_add_social_ids_to_users_table	1
5	2025_11_27_060054_add_avatar_to_users_table	1
6	2025_11_29_063951_create_saas_reviews_table	1
7	2025_12_01_061907_add_godaddy_shopper_id_to_users	1
8	2025_12_01_071627_add_username_and_split_name_to_users	1
9	2025_12_03_085947_create_subscriptions_table	2
10	2025_12_03_085948_create_invoices_table	2
12	2025_12_04_071441_create_admins_table	3
13	2025_12_04_073046_create_notifications_table	3
14	2025_12_04_093146_add_partner_fields_to_users_table	3
17	2025_12_04_100833_add_partner_status_to_users_table	4
18	2025_12_04_051135_create_saas_products_table	5
19	2025_12_06_071408_create_carts_table	6
20	2025_12_08_041159_create_chatbot_tables	7
21	2025_12_09_062930_add_user_id_to_chat_sessions_table	8
22	2025_12_09_065859_create_hero_settings_table	9
23	2025_12_13_114736_add_username_to_users_table	10
24	2025_12_14_072621_create_products_table	11
25	2025_12_14_072629_create_product_features_table	11
26	2025_12_14_094043_add_discount_price_to_products_table	11
27	2025_12_14_103449_create_orders_table	11
28	2025_12_14_103450_create_order_items_table	11
29	2025_12_17_051108_add_domain_details_to_products_table	12
30	2025_12_17_091502_add_is_banned_to_users_table	12
31	2025_12_18_063901_add_plans_to_saas_products_table	13
32	2025_12_19_085211_create_portfolios_table	14
33	2025_12_24_060019_add_discount_config_to_products_table	15
34	2026_03_09_091718_create_visitor_logs_table	16
35	2026_03_12_121935_create_chatbot_knowledge_table	16
37	2026_03_12_121935_create_chatbot_leads_table	17
38	2026_05_19_044933_create_user_email_accounts_table	18
39	2026_07_10_131951_add_payment_proof_to_orders_table	19
40	2026_07_13_052230_add_live_chat_to_chatbot_leads	20
41	2026_08_12_090000_create_helpdesk_users_table	21
42	2026_08_14_151130_add_promo_fields_to_hero_settings_table	22
43	2026_08_14_182242_create_tickets_table	22
44	2026_08_14_182306_create_ticket_messages_table	22
\.


--
-- Data for Name: notifications; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) FROM stdin;
2f5f78db-4d9f-46b8-bbdc-4ceabe180111	App\\Notifications\\SaasApprovedNotification	App\\Models\\User	1	{"title":"Aplikasi Disetujui!","message":"Aplikasi 'Akun Partner FutureCloud' Anda telah disetujui dan kini tayang di marketplace.","icon":"ri-checkbox-circle-fill","color":"text-green-500","link":"https:\\/\\/futurecloud.id\\/saas-marketplace"}	2025-12-05 09:01:09	2025-12-05 09:00:43	2025-12-05 09:01:09
\.


--
-- Data for Name: order_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.order_items (id, order_id, product_name, type, price, billing_cycle, configuration, created_at, updated_at) FROM stdin;
1	1	Premium Domain (sixperience.id)	domain	1800000.00	1 Year(s)	{"years":1,"domain":"sixperience.id","notes":"Migrated Service","datacenter":"SG"}	2025-12-17 13:03:43	2025-12-17 13:03:43
2	1	Shared Hosting Business	hosting	1500000.00	annually	{"domain_connection":"sixperience.id","ip_address":"209.74.67.113","username":"sixperience","password":"P@ssw0rd4lw4yspr4y123","datacenter":"SG"}	2025-12-17 13:03:43	2025-12-17 13:03:43
3	2	Shared Hosting (Include Domain)	hosting	1500000.00	annually	{"domain_connection":"dny-filterindo.co.id","ip_address":"209.74.67.113","username":"dnyfilterindo","password":"P@ssw0rd4lw4yspr4y123","datacenter":"SG","notes":"Bundling Hosting + Domain"}	2025-12-17 13:03:43	2025-12-17 13:03:43
4	3	Shared Hosting (Include Domain)	hosting	1500000.00	annually	{"domain_connection":"fkubjakpus.or.id","ip_address":"209.74.67.113","username":"fkubjakpus","password":"P@ssw0rd4lw4yspr4y123","datacenter":"SG","notes":"Bundling Hosting + Domain"}	2025-12-17 13:03:44	2025-12-17 13:03:44
24	21	Chatbot Plugin	saas	250000.00	annually	"{\\"domain_connection\\":null,\\"license_key\\":\\"FC-LIC-0024-DQIAPW\\",\\"expired_at\\":\\"2027-07-11 05:09:22\\"}"	2026-07-11 05:04:30	2026-07-11 05:09:22
25	21	Monitoring Visitor Plugin	saas	250000.00	annually	"{\\"domain_connection\\":null,\\"license_key\\":\\"FC-LIC-0025-AAU5J2\\",\\"expired_at\\":\\"2027-07-11 05:09:22\\"}"	2026-07-11 05:04:30	2026-07-11 05:09:22
26	22	Chatbot Plugin	saas	250000.00	annually	"{\\"domain_connection\\":null,\\"license_key\\":\\"FC-LIC-0026-MLLEKR\\",\\"expired_at\\":\\"2027-07-11 05:28:37\\"}"	2026-07-11 05:26:17	2026-07-11 05:28:37
41	36	Chatbot Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0041-J0SC4E","expired_at":"2027-07-14 11:30:09","status":"active","is_installed":true}	2026-07-14 11:16:29	2026-07-14 12:25:22
53	45	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0053-4P1R2K","expired_at":"2027-07-15 22:54:51","status":"active","is_installed":true}	2026-07-15 22:54:45	2026-07-15 22:55:47
46	40	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0046-ACUYU5","expired_at":"2027-07-15 15:56:19","status":"active","is_installed":true}	2026-07-15 15:14:13	2026-07-15 16:59:13
42	37	Chatbot Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0042-NOGOGA","expired_at":"2027-07-14 13:20:59","status":"active","is_installed":true,"bot_name":"Aku Aja","bot_color":"#000000"}	2026-07-14 13:17:40	2026-07-15 17:17:22
56	47	Chatbot Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0056-I4HAF2","expired_at":"2027-08-03 11:37:11","status":"active","is_installed":true,"bot_name":"Sixperience Ai","bot_color":"#ff0e6a"}	2026-08-03 11:37:00	2026-08-03 17:28:32
58	48	Chatbot Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0058-2GTAJ9","expired_at":"2027-08-03 11:38:44","status":"active","is_installed":true,"bot_name":"Dny Ai","bot_color":"#54a4a8","whatsapp_number":"6281280015042","db_allow_read":true,"db_host":"127.0.0.1","db_port":"3306","db_database":null,"db_username":"dnyfilterindo","db_password":"P@ssw0rd4lw4yspr4y123","db_allowed_tables":[],"integration_type":"google_sheet","spreadsheet_id":"1IHwDEtK_N2chngwYdBLWw7AqRWKxKJ8IA-gu5lcoLs8","sheet_name_range":null}	2026-08-03 11:38:35	2026-09-01 18:44:28
54	46	Chatbot Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0054-4TXEKK","expired_at":"2027-08-03 10:38:52","status":"active","is_installed":true,"bot_name":"Chatbot Ai","bot_color":"#059669","whatsapp_number":null,"db_allow_read":true,"db_host":"aws-0-ap-southeast-1.pooler.supabase.com","db_port":"6543","db_database":"postgres","db_username":"postgres.szoqkhnatblzasgfnjcf","db_password":"postgre-smartrack@future","db_allowed_tables":["subscription_packages"]}	2026-08-03 10:38:29	2026-09-01 09:52:23
40	35	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0040-U4OFN0","expired_at":"2027-07-14 11:30:16","status":"active","is_installed":true}	2026-07-14 10:16:52	2026-07-14 12:14:04
44	39	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0044-I5PNQT","expired_at":"2027-07-14 15:30:44","status":"active","is_installed":true}	2026-07-14 15:30:34	2026-07-14 15:55:53
45	40	Chatbot Plugin	saas	250000.00	annually	"{\\"domain_connection\\":null,\\"license_key\\":\\"FC-LIC-0045-W2ZYLM\\",\\"expired_at\\":\\"2027-07-15 15:56:19\\",\\"status\\":\\"active\\"}"	2026-07-15 15:14:13	2026-07-15 15:56:19
59	48	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0059-YQVDYT","expired_at":"2027-08-03 11:38:44","status":"active","is_installed":true}	2026-08-03 11:38:35	2026-08-03 17:49:04
61	50	ghrysh.com	domain	364000.00	1 Year(s)	"{\\"years\\":\\"1\\",\\"action\\":\\"register\\"}"	2026-08-14 14:10:39	2026-08-14 14:10:39
52	44	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0052-N1TMZC","expired_at":"2027-07-15 22:29:36","status":"active","is_installed":true}	2026-07-15 22:29:25	2026-07-15 22:50:40
51	44	Chatbot Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0051-MEEVT1","expired_at":"2027-07-15 22:29:36","status":"active","is_installed":true}	2026-07-15 22:29:25	2026-07-15 22:52:24
55	46	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0055-8BLA8O","expired_at":"2027-08-03 10:38:54","status":"active","is_installed":true}	2026-08-03 10:38:29	2026-08-03 17:54:28
62	51	Chatbot Plugin	saas	79000.00	monthly	"{\\"domain_connection\\":null}"	2026-08-14 17:56:30	2026-08-14 17:56:30
63	52	ghrysh.com	domain	364000.00	1 Year(s)	"{\\"years\\":\\"1\\",\\"action\\":null}"	2026-08-14 21:17:39	2026-08-14 21:17:39
60	49	Monitoring Visitor Plugin	saas	250000.00	annually	{"domain_connection":null,"license_key":"FC-LIC-0060-SR6VUU","expired_at":"2027-08-03 13:10:17","status":"active","is_installed":true}	2026-08-03 13:10:07	2026-08-03 13:10:40
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orders (id, user_id, invoice_number, total_amount, payment_method, status, paid_at, created_at, updated_at, payment_proof) FROM stdin;
1	9	INV-MIG-UPWFJZ	3300000.00	bank_transfer	paid	2025-12-12 13:03:43	2025-12-12 13:03:43	2025-12-17 13:03:43	\N
2	10	INV-MIG-2GRTTU	1500000.00	bank_transfer	paid	2025-12-15 13:03:43	2025-12-15 13:03:43	2025-12-17 13:03:43	\N
3	15	INV-MIG-3PBDLP	1500000.00	bank_transfer	paid	2025-12-15 13:03:44	2025-12-15 13:03:44	2025-12-17 13:03:44	\N
38	21	INV-20260714-FLNIZ	277500.00	bank_bni	paid	2026-07-14 14:21:14	2026-07-14 14:20:08	2026-07-14 14:21:14	proofs/JoGdUGaAw53aQnNscB8fw2iioOSnag8tIEhkpJHx.jpg
20	1	INV-20260710-OSJ2Q	111000.00	bank_bni	paid	2026-07-10 14:30:04	2026-07-10 14:27:55	2026-07-10 14:30:04	proofs/7IY7EHkPEX2Omw8BlvttrLj2jfPtA9rXuRgdQMzU.png
21	20	INV-20260711-GGHTP	555000.00	bank_bni	paid	2026-07-11 05:09:22	2026-07-11 05:04:30	2026-07-11 05:09:22	proofs/VSAnkOzNzsLgwlT7pQpVLkR5pISdFxrmKJWZxcvq.jpg
22	6	INV-20260711-B51UN	277500.00	bank_bni	paid	2026-07-11 05:28:38	2026-07-11 05:26:17	2026-07-11 05:28:38	\N
24	6	INV-20260711-S9JKT	277500.00	bank_bni	paid	2026-07-11 06:26:27	2026-07-11 06:26:16	2026-07-11 06:26:27	\N
25	1	INV-20260713-TJYXJ	277500.00	bank_bni	paid	2026-07-13 10:45:06	2026-07-13 10:44:55	2026-07-13 10:45:06	\N
26	1	INV-20260713-2KT9V	277500.00	bank_bni	paid	2026-07-13 10:51:16	2026-07-13 10:51:08	2026-07-13 10:51:16	\N
27	1	INV-20260713-BJBCR	277500.00	bank_bni	paid	2026-07-13 11:01:28	2026-07-13 11:01:20	2026-07-13 11:01:28	\N
28	1	INV-20260713-PNUSV	277500.00	bank_bni	paid	2026-07-13 11:26:58	2026-07-13 11:26:50	2026-07-13 11:26:58	\N
29	1	INV-20260714-UXH21	277500.00	bank_bni	paid	2026-07-14 03:58:51	2026-07-14 03:58:19	2026-07-14 03:58:51	\N
30	1	INV-20260714-XIXYV	277500.00	bank_bni	paid	2026-07-14 04:00:29	2026-07-14 04:00:20	2026-07-14 04:00:29	\N
31	1	INV-20260714-5SXE4	277500.00	bank_bni	paid	2026-07-14 04:41:26	2026-07-14 04:41:16	2026-07-14 04:41:26	\N
32	1	INV-20260714-AVYI6	277500.00	bank_bni	paid	2026-07-14 06:49:24	2026-07-14 06:49:10	2026-07-14 06:49:24	\N
33	19	INV-20260714-WJVY6	277500.00	bank_bni	paid	2026-07-14 09:34:24	2026-07-14 09:24:06	2026-07-14 09:34:24	\N
34	19	INV-20260714-QEXPJ	277500.00	bank_bni	paid	2026-07-14 09:34:32	2026-07-14 09:25:32	2026-07-14 09:34:32	\N
39	1	INV-20260714-MAXRE	277500.00	bank_bni	paid	2026-07-14 15:30:47	2026-07-14 15:30:34	2026-07-14 15:30:47	\N
36	12	INV-20260714-OO5RS	277500.00	bank_bni	paid	2026-07-14 11:30:10	2026-07-14 11:16:29	2026-07-14 11:30:10	proofs/71hWwWAUhXSpksvAHifBIyQksYXGeyVmr8RsLoL3.png
35	12	INV-20260714-FJC7P	277500.00	bank_bni	paid	2026-07-14 11:30:17	2026-07-14 10:16:52	2026-07-14 11:30:17	proofs/RryDK708JZ6gZWf517mttMOeSoLcRD2ARPfXUnG6.png
37	1	INV-20260714-MU49W	277500.00	bank_bni	paid	2026-07-14 13:21:00	2026-07-14 13:17:40	2026-07-14 13:21:00	\N
40	12	INV-20260715-7AQIA	555000.00	bank_bni	paid	2026-07-15 15:56:19	2026-07-15 15:14:13	2026-07-15 15:56:19	proofs/5P2E8FJ5MifYPNMG9P1Ex4bQxhS4xjc65HyW8skF.png
41	21	INV-20260715-SG9P4	277500.00	bank_bni	paid	2026-07-15 18:30:56	2026-07-15 17:33:45	2026-07-15 18:30:56	proofs/WsbqEjUFlQDGl0j1JoUJHHDgvsSjOIu15b7tXEq4.jpg
42	19	INV-20260715-IFOE6	277500.00	bank_bni	paid	2026-07-15 18:31:04	2026-07-15 18:06:24	2026-07-15 18:31:04	\N
43	19	INV-20260715-NZUSM	555000.00	bank_bni	paid	2026-07-15 18:31:11	2026-07-15 18:07:24	2026-07-15 18:31:11	\N
44	19	INV-20260715-GN1Q7	555000.00	bank_bni	paid	2026-07-15 22:29:36	2026-07-15 22:29:25	2026-07-15 22:29:36	\N
45	21	INV-20260715-PR4N8	277500.00	bank_bni	paid	2026-07-15 22:54:51	2026-07-15 22:54:45	2026-07-15 22:54:55	proofs/imElrbVZzRc0z9HIzH0gm5MowOEcBLQUV2HlVMyR.jpg
46	22	INV-20260803-J5QEW	555000.00	bank_bni	paid	2026-08-03 10:38:55	2026-08-03 10:38:29	2026-08-03 10:38:55	\N
47	9	INV-20260803-534DF	555000.00	bank_bni	paid	2026-08-03 11:37:12	2026-08-03 11:37:00	2026-08-03 11:37:12	\N
48	10	INV-20260803-7BNF4	555000.00	bank_bni	paid	2026-08-03 11:38:45	2026-08-03 11:38:35	2026-08-03 11:38:45	\N
49	9	INV-20260803-O5CJR	277500.00	bank_bni	paid	2026-08-03 13:10:17	2026-08-03 13:10:07	2026-08-03 13:10:17	\N
50	1	INV-20260814-XX9KI	404040.00	bank_bni	pending	\N	2026-08-14 14:10:39	2026-08-14 14:10:39	\N
51	1	INV-20260814-6HUCA	87690.00	bank_bni	pending	\N	2026-08-14 17:56:30	2026-08-14 17:56:30	\N
52	1	INV-20260814-5LEGF	404040.00	bank_bni	pending	\N	2026-08-14 21:17:39	2026-08-14 21:17:39	\N
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
afsalprimamaulaaa@gmail.com	$2y$12$OMRpyPx/yccqLwrNqNWQ1.PiZM3TPlhRoWRnxc3iiECL4Ri/KmbsC	2026-06-03 08:00:29
gispi.desu@gmail.com	$2y$12$IkkTblhkQQ4na29uz.Y0J.VBqKYz48hSz10XxvZFqYGHGtL1Gpl8q	2026-08-04 11:02:17
\.


--
-- Data for Name: portfolios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.portfolios (id, title, slug, category, client, url, description, image, created_at, updated_at) FROM stdin;
14	Portal FKUB Jakarta Pusat	portal-fkub-jakarta-pusat	Web Development	\N	https://fkubjakpus.or.id	Website resmi Forum Kerukunan Umat Beragama Jakarta Pusat untuk publikasi berita, galeri, dan agenda kegiatan forum.	portfolios/Qg3pbfTS8TpvXwZPZeoQfC723Oi0YbgzpDxGsVkj.webp	2026-08-14 20:29:36	2026-08-14 20:53:25
1	Sixperience Digital Platform	sixperience-digital-platform	Web Development	\N	https://sixperience.id	Platform digital interaktif terintegrasi untuk kebutuhan event organizer dan pengalaman acara yang imersif.	portfolios/GL1U4KAdcyOHkWmMeQycnUts0LSWUlT1SMOywZmT.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
2	PT DNY Filterindo Company Profile	pt-dny-filterindo-company-profile	Web Development	\N	https://dny-filterindo.co.id	Website company profile profesional untuk perusahaan manufaktur filter industri dengan katalog produk yang responsif.	portfolios/5ImH9mcPR1wNQtAmQFHYKNt4LYHO5ow9MPdCiA18.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
3	Portal Resmi PKUB Kemenag RI	portal-resmi-pkub-kemenag-ri	Web Development	\N	https://pkubpusat.kemenag.go.id	Portal informasi resmi Pusat Kerukunan Umat Beragama Kementerian Agama RI dengan sistem manajemen konten berskala nasional.	portfolios/zZUTIGm7P27GmXUT57p9Emhqr8Zhh3Jsk9xn2ZOi.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
4	Early Warning System (EWS) PKUB	early-warning-system-ews-pkub	Web Development	\N	https://pkubpusat.kemenag.go.id/ews	Sistem peringatan dini berbasis web untuk mendeteksi dan mencegah potensi konflik keagamaan, dilengkapi dashboard analitik real-time.	portfolios/qOkd4g6yHi8RNytXDd0oXPzIIsj5vBvpR8GHtNsF.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
5	Smartrack Fleet Management	smartrack-fleet-management	SaaS Application	\N	https://smartrack.id	Platform manajemen armada dan pelacakan GPS kendaraan pintar dengan sistem pemantauan rute dan laporan efisiensi.	portfolios/Vi1KXmFJ3GUPLkl6wngfzZ3zMb22vb2HZTaTEs7w.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
6	ScanYuk QR Platform	scanyuk-qr-platform	Web Development	\N	https://scanyuk.com	Platform pembuatan dan manajemen QR Code dinamis untuk kebutuhan menu restoran, ticketing, dan sistem kehadiran.	portfolios/vDQvQaEsuc0ilgVrwKdxNgVVY6FR04DuLFjX1thi.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
7	Ngajak Undangan Digital	ngajak-undangan-digital	Web Development	\N	https://ngajak.my.id	Layanan pembuatan undangan pernikahan dan acara digital (website) dengan desain elegan dan fitur RSVP interaktif.	portfolios/4RfwwV67HUbtn1RGFNQeUgCK4ttgrThZs0QsSvB6.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
8	Katalog Online Wonosofa	katalog-online-wonosofa	Web Development	\N	https://wonosofa.my.id	Katalog produk dan website representasi bisnis mebel/sofa dengan antarmuka bersih dan sistem pemesanan yang mudah.	portfolios/AUUx5rt3nZUQWp5Fdpn5xy3WtYoK1KeSwtqeGlWy.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
9	Vidici Corporate Website	vidici-corporate-website	Web Development	\N	https://vidici.id	Website representasi korporat dengan desain modern dan performa tinggi untuk membangun kredibilitas merek digital.	portfolios/BaGl56TYOW1foI6FXMQHAB3aocSIyqoDURRk06go.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
10	SIMSDM Kementerian Agama	simsdm-kementerian-agama	Web Development	\N	https://simsdm.kemenag.go.id	Sistem Informasi Manajemen Sumber Daya Manusia terpadu yang dirancang khusus untuk memenuhi administrasi pegawai Kemenag.	portfolios/TQC80LMNhMoosipjiHRqiLBQrVwlhCvXa8zpVm3d.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
11	Commawear Online Store	commawear-online-store	Web Development	\N	https://commawear.id	Platform e-commerce fashion modern dengan pengalaman belanja pengguna yang mulus dan manajemen katalog dinamis.	portfolios/yIJPzB4WrDYYPug8XxC2DfNzNS7FaM3HzQtALRS9.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
12	Leadly	leadly	Web Development	\N	https://lead.futurecloud.id	Sistem internal Customer Relationship Management (CRM) untuk menangkap, mengelola, dan mengonversi leads bisnis secara efisien.	portfolios/cF0JzEOl8i27eCuiWzin7h2HyMOK3V2xJtFy0jG4.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
13	FutureCloud ERP System	futurecloud-erp-system	SaaS Application	\N	https://erp.futurecloud.id	Sistem Enterprise Resource Planning (ERP) berbasis cloud untuk otomasi manajemen operasional, keuangan, dan sumber daya perusahaan.	portfolios/tzLELiiz9zHiGwXJCBa1MWp9csGOIRPogf2omWPH.webp	2026-08-14 20:29:36	2026-08-14 20:48:25
\.


--
-- Data for Name: product_features; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.product_features (id, product_id, feature_text, created_at, updated_at) FROM stdin;
1	1	1 Domain	2025-12-24 19:07:21	2025-12-24 19:07:21
2	1	Free DNS	2025-12-24 19:07:21	2025-12-24 19:07:21
3	1	Email Fwd	2025-12-24 19:07:21	2025-12-24 19:07:21
4	1	Privacy Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
5	2	3 Domains	2025-12-24 19:07:21	2025-12-24 19:07:21
6	2	Adv DNS	2025-12-24 19:07:21	2025-12-24 19:07:21
7	2	Unlimited Email	2025-12-24 19:07:21	2025-12-24 19:07:21
8	2	Premium Privacy	2025-12-24 19:07:21	2025-12-24 19:07:21
9	2	Free Transfer	2025-12-24 19:07:21	2025-12-24 19:07:21
10	3	10 Domains	2025-12-24 19:07:21	2025-12-24 19:07:21
11	3	Ent DNS	2025-12-24 19:07:21	2025-12-24 19:07:21
12	3	Unlimited Email	2025-12-24 19:07:21	2025-12-24 19:07:21
13	3	Wildcard SSL	2025-12-24 19:07:21	2025-12-24 19:07:21
14	3	Dedicated Support	2025-12-24 19:07:21	2025-12-24 19:07:21
30	7	2 CPU Cores	2025-12-24 19:07:21	2025-12-24 19:07:21
31	7	2 GB RAM	2025-12-24 19:07:21	2025-12-24 19:07:21
32	7	40 GB SSD RAID 10	2025-12-24 19:07:21	2025-12-24 19:07:21
33	7	1000 GB Bandwidth	2025-12-24 19:07:21	2025-12-24 19:07:21
34	8	4 CPU Cores	2025-12-24 19:07:21	2025-12-24 19:07:21
35	8	6 GB RAM	2025-12-24 19:07:21	2025-12-24 19:07:21
36	8	120 GB SSD RAID 10	2025-12-24 19:07:21	2025-12-24 19:07:21
37	8	3000 GB Bandwidth	2025-12-24 19:07:21	2025-12-24 19:07:21
38	9	8 CPU Cores	2025-12-24 19:07:21	2025-12-24 19:07:21
39	9	12 GB RAM	2025-12-24 19:07:21	2025-12-24 19:07:21
40	9	240 GB SSD RAID 10	2025-12-24 19:07:21	2025-12-24 19:07:21
41	9	6000 GB Bandwidth	2025-12-24 19:07:21	2025-12-24 19:07:21
42	10	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
43	10	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
46	12	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
47	12	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
48	13	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
49	13	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
50	14	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
51	14	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
52	15	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
53	15	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
54	16	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
55	16	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
56	17	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
57	17	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
58	18	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
59	18	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
60	19	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
61	19	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
62	20	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
63	20	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
64	21	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
65	21	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
66	22	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
67	22	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
68	23	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
69	23	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
70	24	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
71	24	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
72	25	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
73	25	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
74	26	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
75	26	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
76	27	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
77	27	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
78	28	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
79	28	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
80	29	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
81	29	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
82	30	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
83	30	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
84	31	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
85	31	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
86	32	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
87	32	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
88	33	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
89	33	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
90	34	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
91	34	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
92	35	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
93	35	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
94	36	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
95	36	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
96	37	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
97	37	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
98	38	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
99	38	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
100	39	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
101	39	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
102	40	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
103	40	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
104	41	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
105	41	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
106	42	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
107	42	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
108	43	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
109	43	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
110	44	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
111	44	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
112	45	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
113	45	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
114	46	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
115	46	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
116	47	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
117	47	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
118	48	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
119	48	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
120	49	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
121	49	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
122	50	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
123	50	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
124	51	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
125	51	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
126	52	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
127	52	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
128	53	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
129	53	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
130	54	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
131	54	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
132	55	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
133	55	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
134	56	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
135	56	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
136	57	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
137	57	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
138	58	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
139	58	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
140	59	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
141	59	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
142	60	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
143	60	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
144	61	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
145	61	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
146	62	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
147	62	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
148	63	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
149	63	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
150	64	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
151	64	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
152	65	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
153	65	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
154	66	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
155	66	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
156	67	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
157	67	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
158	68	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
159	68	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
160	69	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
161	69	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
162	70	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
163	70	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
164	71	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
165	71	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
166	72	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
167	72	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
168	73	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
169	73	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
170	74	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
171	74	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
172	75	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
173	75	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
174	76	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
175	76	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
176	77	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
177	77	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
178	78	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
179	78	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
180	79	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
181	79	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
182	80	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
183	80	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
184	81	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
185	81	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
186	82	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
187	82	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
188	83	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
189	83	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
190	84	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
191	84	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
192	85	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
193	85	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
194	86	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
195	86	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
196	87	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
197	87	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
198	88	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
199	88	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
200	89	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
201	89	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
202	90	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
203	90	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
204	91	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
205	91	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
206	92	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
207	92	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
208	93	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
209	93	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
210	94	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
211	94	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
212	95	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
213	95	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
214	96	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
215	96	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
216	97	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
217	97	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
218	98	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
219	98	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
220	99	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
221	99	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
222	100	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
223	100	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
224	101	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
225	101	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
226	102	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
227	102	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
228	103	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
229	103	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
230	104	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
231	104	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
232	105	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
233	105	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
234	106	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
235	106	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
236	107	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
237	107	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
238	108	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
239	108	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
240	109	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
241	109	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
242	110	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
243	110	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
244	111	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
245	111	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
246	112	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
247	112	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
248	113	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
249	113	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
250	114	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
251	114	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
252	115	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
253	115	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
254	116	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
255	116	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
256	117	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
257	117	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
258	118	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
259	118	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
260	119	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
261	119	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
262	120	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
263	120	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
264	121	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
265	121	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
266	122	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
267	122	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
268	123	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
269	123	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
270	124	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
271	124	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
272	125	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
273	125	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
274	126	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
275	126	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
276	127	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
277	127	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
278	128	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
279	128	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
280	129	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
281	129	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
282	130	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
283	130	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
284	131	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
285	131	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
286	132	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
287	132	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
288	133	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
289	133	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
290	134	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
291	134	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
292	135	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
293	135	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
294	136	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
295	136	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
296	137	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
297	137	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
298	138	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
299	138	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
302	140	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
303	140	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
304	141	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
305	141	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
306	142	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
307	142	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
308	143	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
309	143	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
310	144	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
311	144	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
312	145	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
313	145	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
314	146	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
315	146	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
316	147	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
317	147	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
318	148	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
319	148	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
320	149	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
321	149	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
322	150	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
323	150	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
324	151	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
325	151	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
326	152	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
327	152	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
328	153	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
329	153	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
330	154	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
331	154	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
332	155	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
333	155	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
334	156	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
335	156	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
336	157	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
337	157	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
338	158	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
339	158	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
340	159	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
341	159	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
342	160	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
343	160	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
344	161	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
345	161	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
346	162	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
347	162	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
348	163	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
349	163	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
350	164	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
351	164	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
352	165	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
353	165	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
354	166	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
355	166	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
356	167	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
357	167	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
358	168	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
359	168	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
360	169	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
361	169	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
362	170	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
363	170	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
364	171	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
365	171	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
366	172	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
367	172	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
368	173	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
369	173	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
370	174	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
371	174	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
372	175	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
373	175	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
374	176	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
375	176	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
376	177	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
377	177	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
378	178	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
379	178	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
380	179	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
381	179	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
382	180	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
383	180	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
384	181	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
385	181	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
386	182	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
387	182	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
388	183	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
389	183	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
390	184	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
391	184	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
392	185	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
393	185	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
394	186	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
395	186	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
396	187	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
397	187	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
398	188	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
399	188	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
400	189	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
401	189	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
402	190	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
403	190	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
404	191	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
405	191	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
406	192	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
407	192	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
408	193	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
409	193	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
410	194	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
411	194	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
412	195	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
413	195	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
414	196	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
415	196	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
416	197	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
417	197	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
418	198	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
419	198	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
420	199	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
421	199	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
422	200	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
423	200	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
424	201	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
425	201	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
426	202	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
427	202	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
428	203	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
429	203	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
430	204	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
431	204	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
432	205	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
433	205	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
434	206	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
435	206	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
436	207	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
437	207	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
438	208	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
439	208	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
440	209	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
441	209	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
442	210	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
443	210	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
444	211	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
445	211	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
446	212	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
447	212	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
448	213	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
449	213	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
450	214	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
451	214	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
452	215	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
453	215	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
454	216	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
455	216	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
456	217	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
457	217	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
458	218	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
459	218	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
460	219	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
461	219	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
462	220	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
463	220	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
464	221	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
465	221	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
466	222	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
467	222	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
468	223	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
469	223	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
470	224	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
471	224	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
472	225	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
473	225	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
474	226	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
475	226	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
476	227	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
477	227	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
478	228	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
479	228	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
480	229	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
481	229	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
482	230	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
483	230	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
484	231	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
485	231	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
486	232	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
487	232	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
488	233	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
489	233	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
490	234	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
491	234	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
492	235	DNS Management	2025-12-24 19:07:21	2025-12-24 19:07:21
493	235	ID Protection	2025-12-24 19:07:21	2025-12-24 19:07:21
494	236	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
495	236	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
496	237	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
497	237	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
498	238	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
499	238	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
500	239	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
501	239	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
502	240	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
503	240	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
504	241	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
505	241	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
506	242	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
507	242	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
508	243	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
509	243	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
510	244	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
511	244	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
512	245	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
513	245	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
514	246	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
515	246	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
516	247	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
517	247	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
518	248	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
519	248	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
520	249	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
521	249	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
522	250	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
523	250	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
524	251	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
525	251	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
526	252	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
527	252	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
528	253	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
529	253	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
530	254	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
531	254	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
532	255	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
533	255	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
534	256	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
535	256	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
536	257	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
537	257	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
538	258	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
539	258	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
540	259	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
541	259	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
542	260	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
543	260	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
544	261	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
545	261	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
546	262	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
547	262	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
548	263	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
549	263	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
550	264	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
551	264	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
552	265	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
553	265	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
554	266	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
555	266	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
556	267	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
557	267	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
558	268	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
559	268	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
560	269	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
561	269	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
562	270	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
563	270	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
564	271	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
565	271	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
566	272	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
567	272	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
568	273	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
569	273	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
570	274	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
571	274	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
572	275	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
573	275	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
574	276	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
575	277	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
576	278	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
577	279	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
578	280	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
579	281	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
580	282	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
581	283	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
582	283	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
583	284	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
584	284	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
585	285	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
586	285	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
587	286	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
588	286	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
589	287	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
590	287	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
591	288	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
592	288	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
593	289	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
594	289	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
595	290	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
596	290	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
597	291	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
598	291	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
599	292	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
600	292	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
601	293	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
602	293	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
603	294	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
604	294	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
605	295	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
606	295	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
607	296	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
608	296	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
609	297	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
610	297	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
611	298	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
612	298	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
613	299	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
614	299	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
615	300	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
616	300	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
617	301	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
618	301	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
619	302	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
620	302	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
621	303	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
622	303	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
623	304	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
624	304	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
625	305	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
626	305	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
627	306	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
628	306	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
629	307	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
630	307	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
631	308	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
632	308	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
633	309	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
634	309	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
635	310	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
636	310	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
637	311	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
638	311	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
639	312	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
640	312	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
641	313	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
642	313	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
643	314	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
644	314	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
645	315	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
646	315	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
647	316	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
648	316	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
649	317	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
650	317	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
651	318	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
652	318	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
653	319	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
654	319	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
655	320	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
656	320	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
657	321	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
658	321	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
659	322	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
660	322	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
661	323	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
662	323	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
663	324	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
664	324	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
665	325	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
666	325	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
667	326	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
668	326	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
669	327	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
670	327	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
671	328	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
672	328	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
673	329	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
674	329	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
675	330	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
676	330	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
677	331	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
678	331	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
679	332	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
680	332	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
681	333	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
682	333	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
683	334	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
684	334	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
685	335	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
686	335	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
687	336	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
688	336	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
689	337	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
690	337	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
691	338	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
692	338	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
693	339	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
694	339	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
695	340	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
696	340	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
697	341	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
698	341	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
699	342	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
700	342	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
701	343	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
702	343	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
703	344	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
704	344	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
705	345	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
706	345	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
707	346	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
708	346	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
709	347	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
710	347	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
711	348	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
712	348	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
713	349	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
714	349	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
715	350	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
716	350	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
717	351	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
718	351	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
719	352	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
720	352	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
721	353	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
722	353	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
723	354	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
724	354	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
725	355	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
726	355	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
727	356	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
728	356	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
729	357	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
730	357	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
731	358	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
732	358	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
733	359	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
734	359	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
735	360	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
736	360	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
737	361	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
738	361	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
739	362	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
740	362	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
741	363	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
742	363	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
743	364	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
744	364	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
745	365	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
746	365	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
747	366	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
748	366	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
749	367	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
750	367	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
751	368	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
752	368	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
753	369	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
754	369	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
755	370	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
756	370	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
757	371	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
758	371	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
759	372	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
760	372	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
761	373	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
762	373	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
763	374	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
764	374	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
765	375	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
766	375	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
767	376	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
768	376	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
769	377	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
770	377	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
771	378	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
772	378	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
773	379	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
774	379	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
775	380	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
776	380	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
777	381	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
778	381	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
779	382	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
780	382	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
781	383	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
782	383	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
783	384	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
784	384	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
785	385	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
786	385	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
787	386	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
788	386	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
789	387	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
790	387	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
791	388	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
792	388	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
793	389	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
794	389	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
795	390	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
796	390	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
797	391	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
798	391	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
799	392	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
800	392	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
801	393	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
802	393	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
803	394	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
804	394	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
805	395	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
806	395	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
807	396	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
808	396	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
809	397	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
810	397	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
811	398	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
812	398	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
813	399	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
814	399	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
815	400	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
816	400	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
817	401	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
818	401	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
819	402	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
820	402	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
821	403	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
822	403	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
823	404	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
824	404	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
825	405	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
826	405	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
827	406	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
828	406	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
829	407	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
830	407	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
831	408	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
832	408	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
833	409	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
834	409	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
835	410	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
836	410	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
837	411	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
838	411	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
839	412	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
840	412	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
841	413	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
842	413	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
843	414	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
844	414	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
845	415	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
846	415	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
847	416	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
848	416	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
849	417	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
850	417	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
851	418	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
852	418	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
853	419	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
854	419	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
855	420	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
856	420	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
857	421	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
858	421	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
859	422	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
860	422	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
861	423	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
862	423	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
863	424	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
864	424	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
865	425	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
866	425	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
867	426	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
868	426	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
869	427	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
870	427	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
871	428	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
872	428	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
873	429	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
874	429	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
875	430	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
876	430	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
877	431	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
878	431	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
879	432	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
880	432	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
881	433	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
882	433	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
883	434	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
884	434	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
885	435	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
886	435	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
887	436	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
888	436	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
889	437	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
890	437	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
891	438	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
892	438	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
893	439	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
894	439	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
895	440	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
896	440	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
897	441	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
898	441	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
899	442	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
900	442	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
901	443	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
902	443	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
903	444	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
904	444	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
905	445	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
906	445	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
907	446	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
908	446	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
909	447	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
910	447	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
911	448	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
912	448	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
913	449	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
914	449	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
915	450	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
916	450	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
917	451	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
918	451	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
919	452	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
920	452	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
921	453	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
922	453	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
923	454	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
924	454	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
925	455	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
926	455	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
927	456	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
928	456	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
929	457	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
930	457	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
931	458	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
932	458	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
933	459	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
934	459	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
935	460	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
936	460	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
937	461	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
938	461	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
939	462	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
940	462	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
941	463	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
942	463	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
943	464	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
944	464	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
945	465	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
946	465	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
947	466	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
948	466	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
949	467	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
950	467	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
951	468	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
952	468	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
953	469	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
954	469	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
955	470	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
956	470	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
957	471	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
958	471	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
959	472	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
960	472	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
961	473	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
962	473	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
963	474	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
964	474	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
965	475	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
966	475	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
967	476	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
968	476	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
969	477	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
970	477	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
971	478	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
972	478	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
973	479	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
974	479	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
975	480	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
976	480	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
977	481	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
978	481	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
979	482	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
980	482	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
981	483	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
982	483	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
983	484	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
984	484	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
985	485	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
986	485	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
987	486	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
988	486	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
989	487	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
990	487	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
991	488	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
992	488	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
993	489	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
994	489	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
995	490	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
996	490	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
997	491	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
998	491	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
999	492	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1000	492	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1001	493	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1002	493	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1003	494	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1004	494	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1005	495	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1006	495	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1007	496	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1008	496	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1009	497	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1010	497	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1011	498	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1012	498	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1013	499	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1014	499	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1015	500	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1016	500	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1017	501	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1018	501	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1019	502	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1020	502	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1021	503	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1022	503	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1023	504	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1024	504	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1025	505	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1026	505	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1027	506	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1028	506	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1029	507	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1030	507	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1031	508	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1032	508	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1033	509	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1034	509	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1035	510	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1036	510	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1037	511	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1038	511	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1039	512	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1040	512	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1041	513	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1042	513	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1043	514	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1044	514	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1045	515	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1046	515	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1047	516	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1048	516	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1049	517	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1050	517	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1051	518	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1052	518	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1053	519	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1054	519	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1055	520	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1056	520	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1057	521	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1058	521	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1059	522	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1060	522	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1061	523	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1062	523	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1063	524	DNS Management	2025-12-24 19:07:22	2025-12-24 19:07:22
1064	524	ID Protection	2025-12-24 19:07:22	2025-12-24 19:07:22
1065	11	DNS Management	2025-12-24 19:27:28	2025-12-24 19:27:28
1066	11	ID Protection	2025-12-24 19:27:28	2025-12-24 19:27:28
1067	139	DNS Management	2025-12-24 19:42:55	2025-12-24 19:42:55
1068	139	ID Protection	2025-12-24 19:42:55	2025-12-24 19:42:55
1069	4	3 Websites	2025-12-24 19:46:24	2025-12-24 19:46:24
1070	4	20 GB SSD	2025-12-24 19:46:24	2025-12-24 19:46:24
1071	4	30 Mailboxes	2025-12-24 19:46:24	2025-12-24 19:46:24
1072	4	Free SSL	2025-12-24 19:46:24	2025-12-24 19:46:24
1073	4	Datacenter Choice	2025-12-24 19:46:24	2025-12-24 19:46:24
1074	5	Unlimited Websites	2025-12-24 19:48:40	2025-12-24 19:48:40
1075	5	Unmetered SSD	2025-12-24 19:48:40	2025-12-24 19:48:40
1076	5	Unlimited Mailboxes	2025-12-24 19:48:40	2025-12-24 19:48:40
1077	5	AutoBackup	2025-12-24 19:48:40	2025-12-24 19:48:40
1078	5	Free SSL	2025-12-24 19:48:40	2025-12-24 19:48:40
1079	6	Unlimited Websites	2025-12-24 19:50:21	2025-12-24 19:50:21
1080	6	50 GB SSD	2025-12-24 19:50:21	2025-12-24 19:50:21
1081	6	Unlimited Mailboxes	2025-12-24 19:50:21	2025-12-24 19:50:21
1082	6	AutoBackup & Cloud Storage	2025-12-24 19:50:21	2025-12-24 19:50:21
1083	6	Imunify360 Security	2025-12-24 19:50:21	2025-12-24 19:50:21
\.


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, name, slug, type, price, cycle, tag, is_featured, created_at, updated_at, discount_price, renew_price, transfer_price, category, discount_config) FROM stdin;
1	Basic Domain	basic-domain	domain	900000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	\N	\N	Bundling	\N
2	Premium Domain	premium-domain	domain	1800000.00	yr	Most Popular	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	\N	\N	Bundling	\N
3	Business Domain	business-domain	domain	3000000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	\N	\N	Bundling	\N
7	VPS Starter	vps-starter	vps	182500.00	mo	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	\N	\N	General	\N
8	VPS Professional	vps-professional	vps	293000.00	mo	Best Performance	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	\N	\N	General	\N
9	VPS Enterprise	vps-enterprise	vps	533000.00	mo	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	\N	\N	General	\N
10	.0DB	domain-0db	domain	664000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Numeric	\N
35	.AHOY	tld-ahoy	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:55	\N	292000.00	0.00	International	\N
30	.AE.ORG	tld-aeorg	domain	486000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:48	\N	486000.00	457000.00	International	{"register":{"type":"fixed","value":457000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
961	.POJ	tld-poj	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
43	.APARTMENTS	tld-apartments	domain	1419000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:50	\N	1419000.00	1186000.00	Real Estate	{"register":{"type":"fixed","value":1186000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
930	.KENNEL	tld-kennel	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
17	.3DOM	domain-3dom	domain	350500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	Numeric	\N
19	.4FREE	tld-4free	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:55	\N	603000.00	0.00	Numeric	\N
928	.JUN	tld-jun	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	253000.00	0.00	General	\N
50	.ARTIFICIAL	tld-artificial	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:57	\N	447000.00	0.00	International	\N
56	.AUCTION	tld-auction	domain	913000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	913000.00	758000.00	International	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
920	.INCOME	tld-income	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	1730000.00	0.00	General	\N
27	.ADDME	tld-addme	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:02:06	\N	146000.00	0.00	International	\N
40	.AMIGO	tld-amigo	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:02:00	\N	467000.00	0.00	International	\N
41	.ANE	tld-ane	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:51	\N	1691000.00	0.00	International	\N
15	.247	tld-247	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:51	\N	3848000.00	0.00	Numeric	\N
37	.AIRFORCE	tld-airforce	domain	2624000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	2624000.00	2138000.00	International	{"register":{"type":"fixed","value":2138000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
29	.AERO	domain-aero	domain	2029000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2629000.00	2029000.00	International	\N
31	.AF	domain-af	domain	940500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	940500.00	940500.00	International	\N
588	.ORG.MX	tld-orgmx	domain	641000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:44	\N	641000.00	505000.00	General	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
34	.AGS	domain-ags	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	738000.00	738000.00	International	\N
45	.ARCHI	tld-archi	domain	2585000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:45	\N	2585000.00	2138000.00	International	{"register":{"type":"fixed","value":2138000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
36	.AI	domain-ai	domain	1291000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1439000.00	1291000.00	Popular	\N
25	.ACTOR	tld-actor	domain	1069000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:37	\N	1069000.00	913000.00	International	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
12	.1	tld-1	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:02:08	\N	447000.00	0.00	Numeric	\N
39	.AM	domain-am	domain	1402000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1402000.00	1402000.00	International	\N
67	.BEAUTY	tld-beauty	domain	428000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:51	\N	428000.00	342000.00	Lifestyle	\N
42	.AO	domain-ao	domain	5813500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	5813500.00	5813500.00	International	\N
576	.CO.BZ	tld-cobz	domain	962000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-05 07:01:49	\N	962000.00	894000.00	General	{"register":{"type":"fixed","value":894000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
18	.49	tld-49	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:49	\N	1438000.00	0.00	Numeric	\N
48	.ARTE	domain-arte	domain	276500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	350500.00	276500.00	International	\N
20	.4K	tld-4k	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:57	\N	136000.00	0.00	Numeric	\N
49	.ARTICLES	tld-articles	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:54	\N	389000.00	0.00	International	\N
16	.35	tld-35	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:57	\N	583000.00	0.00	Numeric	\N
53	.AT	domain-at	domain	258000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	276500.00	258000.00	International	\N
54	.ATH	tld-ath	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:54	\N	389000.00	0.00	International	\N
55	.ATM	domain-atm	domain	848500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1420500.00	848500.00	International	\N
38	.ALBUMS	tld-albums	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:53	\N	584000.00	0.00	International	\N
14	.1Q	tld-1q	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:55	\N	603000.00	0.00	Numeric	\N
59	.AUTOS	tld-autos	domain	428000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:52	\N	428000.00	342000.00	International	\N
60	.AW	domain-aw	domain	756500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	756500.00	756500.00	International	\N
62	.BA.IT	domain-bait	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	International	\N
64	.BANK	domain-bank	domain	14734000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	16228500.00	16228500.00	Finance	\N
129	.CLOUD	tld-cloud	domain	641000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:43	\N	641000.00	525000.00	Tech	{"register":{"type":"fixed","value":525000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
90	.BRAND	tld-brand	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:54	\N	447000.00	0.00	International	\N
83	.BOND	tld-bond	domain	505000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:45	\N	505000.00	389000.00	International	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
82	.BOATS	tld-boats	domain	428000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:52	\N	428000.00	342000.00	International	\N
121	.CHEAP	tld-cheap	domain	972000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	972000.00	748000.00	Commerce	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
119	.CHARITY	tld-charity	domain	739000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:52	\N	739000.00	544000.00	International	{"register":{"type":"fixed","value":544000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
95	.BUILDERS	tld-builders	domain	855000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	855000.00	680000.00	International	{"register":{"type":"fixed","value":680000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
98	.BUZZ	tld-buzz	domain	816000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	816000.00	0.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
996	.WORLDTOUR	tld-worldtour	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	875000.00	0.00	General	\N
101	.CAB	tld-cab	domain	816000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	816000.00	661000.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
108	.CARE	tld-care	domain	1166000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:37	\N	1166000.00	913000.00	Lifestyle	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
84	.BOOK	domain-book	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	516500.00	516500.00	International	\N
68	.BEER	tld-beer	domain	855000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	855000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
116	.CEO	tld-ceo	domain	2857000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	2857000.00	0.00	International	\N
88	.BOX	domain-box	domain	516500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	516500.00	516500.00	International	\N
1002	.PROFILES	tld-profiles	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
13	.1D	tld-1d	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:02:06	\N	447000.00	0.00	Numeric	\N
91	.BROADWAY	domain-broadway	domain	1051500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1051500.00	1051500.00	International	\N
72	.BID	tld-bid	domain	505000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	194000.00	117000.00	International	\N
120	.CHAT	tld-chat	domain	1147000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:50	\N	1147000.00	933000.00	International	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
76	.BIOMETRIC	tld-biometric	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:49	\N	855000.00	0.00	International	\N
70	.BEST	tld-best	domain	583000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:41	\N	583000.00	0.00	International	{"register":{"type":"fixed","value":486000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
125	.CLEANING	tld-cleaning	domain	1846000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	1846000.00	1555000.00	International	{"register":{"type":"fixed","value":1555000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
97	.BUY	domain-buy	domain	239500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	239500.00	239500.00	Commerce	\N
105	.CAPITAL	tld-capital	domain	1749000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:36	\N	1749000.00	1477000.00	Finance	{"register":{"type":"fixed","value":1477000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
75	.BIO	tld-bio	domain	1652000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	1652000.00	1496000.00	International	{"register":{"type":"fixed","value":1496000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
122	.CHURCH	tld-church	domain	1535000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	1535000.00	1205000.00	International	{"register":{"type":"fixed","value":1205000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
981	.TECHBLOG	tld-techblog	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
92	.BROKER	tld-broker	domain	933000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:52	\N	933000.00	758000.00	International	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
111	.CASA	tld-casa	domain	350000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:44	\N	350000.00	0.00	International	{"register":{"type":"fixed","value":272000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
78	.BLACK	tld-black	domain	1613000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	1613000.00	1341000.00	International	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
106	.CAR	tld-car	domain	46641000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:43	\N	46641000.00	44659000.00	International	{"register":{"type":"fixed","value":44659000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
144	.COM.MX	tld-commx	domain	680000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	680000.00	525000.00	International	{"register":{"type":"fixed","value":272000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
143	.COM.DE	tld-comde	domain	204000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:48	\N	204000.00	165000.00	International	{"register":{"type":"fixed","value":165000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1065	.RL	tld-rl	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
93	.BROWSERS	tld-browsers	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:51	\N	194000.00	0.00	International	\N
180	.DEV	tld-dev	domain	408000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:50	\N	408000.00	311000.00	Tech	{"register":{"type":"fixed","value":311000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
138	.COLOGNE	domain-cologne	domain	350500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	350500.00	International	\N
176	.DEMOCRAT	tld-democrat	domain	807000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	807000.00	671000.00	International	{"register":{"type":"fixed","value":671000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
151	.CONSTRUCTION	tld-construction	domain	991000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:32	\N	991000.00	797000.00	Real Estate	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
171	.DATING	tld-dating	domain	1691000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	1691000.00	1341000.00	Lifestyle	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1111	.W3B	tld-w3b	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	584000.00	0.00	General	\N
1038	.DH	tld-dh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
155	.COOKING	tld-cooking	domain	855000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:35	\N	855000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
148	.COMPARE	domain-compare	domain	295000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	313500.00	313500.00	International	\N
159	.COUPONS	tld-coupons	domain	1166000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:42	\N	1166000.00	1127000.00	International	{"register":{"type":"fixed","value":1127000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
135	.CODES	tld-codes	domain	1807000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	1807000.00	1458000.00	International	{"register":{"type":"fixed","value":1458000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1077	.XB	tld-xb	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
162	.CREDIT	tld-credit	domain	2565000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	2565000.00	2138000.00	Finance	{"register":{"type":"fixed","value":2138000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
157	.COOP	domain-coop	domain	2748500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2748500.00	2748500.00	International	\N
177	.DENTAL	tld-dental	domain	1963000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	1963000.00	1594000.00	International	{"register":{"type":"fixed","value":1594000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
179	.DESIGN	tld-design	domain	1341000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	1341000.00	1147000.00	Media	{"register":{"type":"fixed","value":1147000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
141	.COM.CN	tld-comcn	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:53	\N	467000.00	0.00	International	\N
161	.CPA	domain-cpa	domain	20104000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	20104000.00	20104000.00	International	\N
183	.DIRECT	tld-direct	domain	1050000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	1050000.00	855000.00	International	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
186	.DOCTOR	tld-doctor	domain	3012000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	3012000.00	2390000.00	International	{"register":{"type":"fixed","value":2390000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
166	.CRYPTO	domain-crypto	domain	221500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	258000.00	258000.00	International	\N
156	.COOL	tld-cool	domain	991000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	991000.00	933000.00	International	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
168	.CZ	domain-cz	domain	332000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	332000.00	International	\N
178	.DENTIST	tld-dentist	domain	1594000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:49	\N	1594000.00	1244000.00	International	{"register":{"type":"fixed","value":1244000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
175	.DELIVERY	tld-delivery	domain	1555000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:49	\N	1555000.00	1283000.00	International	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
170	.DATE	tld-date	domain	505000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	194000.00	117000.00	Lifestyle	\N
189	.DOWNLOAD	tld-download	domain	505000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:42	\N	194000.00	117000.00	Tech	\N
142	.COM.CO	tld-comco	domain	515000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:52	\N	515000.00	379000.00	International	{"register":{"type":"fixed","value":379000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
181	.DIAMONDS	tld-diamonds	domain	1419000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	1419000.00	1127000.00	International	{"register":{"type":"fixed","value":1127000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
241	.GDN	tld-gdn	domain	292000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	292000.00	0.00	International	{"register":{"type":"fixed","value":233000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
248	.GMBH	tld-gmbh	domain	1108000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	1108000.00	933000.00	International	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
77	.BIZ	tld-biz	domain	564000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:44	\N	564000.00	428000.00	Popular	{"register":{"type":"fixed","value":467000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
192	.ECONOMICS	tld-economics	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:48	\N	1944000.00	0.00	International	\N
167	.CX	tld-cx	domain	525000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:50	\N	525000.00	389000.00	International	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
246	.GLASS	tld-glass	domain	1943000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1943000.00	1496000.00	International	{"register":{"type":"fixed","value":1496000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
228	.FOUNDATION	tld-foundation	domain	739000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	739000.00	544000.00	International	{"register":{"type":"fixed","value":544000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
235	.GALLERY	tld-gallery	domain	719000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:38	\N	719000.00	583000.00	Media	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
197	.ENGINEERING	tld-engineering	domain	1671000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:36	\N	1671000.00	1341000.00	International	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
204	.EXPERT	tld-expert	domain	1603000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	1603000.00	1273000.00	International	{"register":{"type":"fixed","value":1273000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
221	.FITNESS	tld-fitness	domain	1069000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	1069000.00	855000.00	Lifestyle	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
202	.EVENTS	tld-events	domain	1127000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	1127000.00	933000.00	International	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
243	.GIFT	tld-gift	domain	467000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	467000.00	0.00	Commerce	{"register":{"type":"fixed","value":408000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
207	.FAIL	tld-fail	domain	991000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:37	\N	991000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
231	.FUND	tld-fund	domain	1807000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	1807000.00	1458000.00	Finance	{"register":{"type":"fixed","value":1458000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
227	.FORSALE	tld-forsale	domain	923000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	923000.00	748000.00	International	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
215	.FILM	tld-film	domain	1905000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:42	\N	1905000.00	1516000.00	Media	{"register":{"type":"fixed","value":1516000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
244	.GIFTS	tld-gifts	domain	923000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	923000.00	748000.00	International	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
238	.GARDEN	tld-garden	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	855000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
224	.FLOWERS	tld-flowers	domain	3109000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	3109000.00	2701000.00	International	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
249	.GOLD	tld-gold	domain	2546000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	2546000.00	2118000.00	Finance	{"register":{"type":"fixed","value":2118000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
208	.FAITH	tld-faith	domain	505000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	330000.00	253000.00	International	\N
230	.FUN	tld-fun	domain	816000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	651000.00	690000.00	Lifestyle	\N
209	.FAMILY	tld-family	domain	972000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:50	\N	972000.00	797000.00	Lifestyle	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
206	.EXPRESS	tld-express	domain	972000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:50	\N	972000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
240	.GD	domain-gd	domain	701000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	811500.00	701000.00	International	\N
251	.GOP	domain-gop	domain	239500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	International	\N
252	.GOSSIP	domain-gossip	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
253	.GOV	domain-gov	domain	295000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	International	\N
284	.IM	tld-im	domain	253000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:53	\N	253000.00	0.00	International	{"register":{"type":"fixed","value":165000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
305	.KIM	tld-kim	domain	641000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	641000.00	476000.00	International	{"register":{"type":"fixed","value":476000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
269	.HOMES	tld-homes	domain	428000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:52	\N	428000.00	342000.00	International	\N
1064	.QO	tld-qo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
286	.IMMOBILIEN	tld-immobilien	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	855000.00	777000.00	International	{"register":{"type":"fixed","value":777000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
315	.LAWYER	tld-lawyer	domain	1302000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	1302000.00	1283000.00	International	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
295	.INVESTMENTS	tld-investments	domain	3245000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	3245000.00	2662000.00	Finance	{"register":{"type":"fixed","value":2662000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
270	.HORSE	tld-horse	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:35	\N	855000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
275	.HOW	tld-how	domain	816000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	816000.00	0.00	International	{"register":{"type":"fixed","value":603000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
268	.HOLIDAY	tld-holiday	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	1594000.00	1322000.00	Location	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
810	.ANNEX	tld-annex	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	272000.00	0.00	General	\N
263	.HAUS	tld-haus	domain	739000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:49	\N	739000.00	700000.00	International	{"register":{"type":"fixed","value":700000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
265	.HELP	tld-help	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	855000.00	641000.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
592	.STORAGE	tld-storage	domain	16674000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	16674000.00	11622000.00	General	{"register":{"type":"fixed","value":11641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
277	.CO.ID	domain-coid	domain	138000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	138000.00	138000.00	Indonesia	\N
278	.AC.ID	domain-acid	domain	66000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	66000.00	66000.00	Indonesia	\N
279	.SCH.ID	domain-schid	domain	66000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	66000.00	66000.00	Indonesia	\N
280	.WEB.ID	domain-webid	domain	66000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	66000.00	66000.00	Indonesia	\N
281	.MY.ID	domain-myid	domain	12000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	12000.00	12000.00	Indonesia	\N
282	.BIZ.ID	domain-bizid	domain	12000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	12000.00	12000.00	Indonesia	\N
283	.IE	domain-ie	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	313500.00	313500.00	International	\N
272	.HOST	tld-host	domain	2138000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	923000.00	1706000.00	Tech	\N
304	.KAUFEN	tld-kaufen	domain	653000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:42	\N	653000.00	583000.00	International	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
313	.LAT	tld-lat	domain	797000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	797000.00	641000.00	International	\N
591	.TO	tld-to	domain	777000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:44	\N	777000.00	777000.00	General	\N
311	.LA	tld-la	domain	816000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	816000.00	641000.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
276	.ID	tld-id	domain	505000.00	yr	Best Seller	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	505000.00	447000.00	Indonesia	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
256	.GREEN	tld-green	domain	2002000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	2002000.00	1652000.00	International	{"register":{"type":"fixed","value":1652000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
258	.GROUP	tld-group	domain	700000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	700000.00	525000.00	International	{"register":{"type":"fixed","value":525000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
312	.LAND	tld-land	domain	1069000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:32	\N	1069000.00	855000.00	Real Estate	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
299	.ISTANBUL	domain-istanbul	domain	369000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
300	.IT	domain-it	domain	258000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	203000.00	258000.00	International	\N
303	.JP	domain-jp	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	406000.00	Location	\N
308	.KOELN	domain-koeln	domain	350500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	350500.00	International	\N
309	.KR	domain-kr	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	442500.00	442500.00	International	\N
369	.OBSERVER	tld-observer	domain	330000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	330000.00	0.00	International	{"register":{"type":"fixed","value":233000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
326	.LLC	tld-llc	domain	1069000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	1069000.00	875000.00	International	{"register":{"type":"fixed","value":875000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
330	.LOL	tld-lol	domain	797000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	797000.00	641000.00	International	\N
368	.NYC	tld-nyc	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	855000.00	641000.00	Location	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
345	.MEME	tld-meme	domain	311000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:53	\N	311000.00	253000.00	International	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
337	.MAKEUP	tld-makeup	domain	428000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	428000.00	342000.00	International	\N
366	.NL	tld-nl	domain	175000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:51	\N	175000.00	146000.00	International	{"register":{"type":"fixed","value":146000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
354	.MONSTER	tld-monster	domain	428000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	428000.00	342000.00	International	\N
361	.NETWORK	tld-network	domain	913000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	913000.00	719000.00	Tech	{"register":{"type":"fixed","value":719000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
325	.LIVESTREAMING	tld-livestreaming	domain	0.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:48	\N	1944000.00	0.00	International	\N
371	.ONG	tld-ong	domain	486000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	486000.00	369000.00	International	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
335	.LUXURY	tld-luxury	domain	0.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:47	\N	9736000.00	0.00	International	\N
322	.LIMO	tld-limo	domain	1341000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1341000.00	1127000.00	International	{"register":{"type":"fixed","value":1127000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
363	.NEWS	tld-news	domain	807000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	807000.00	671000.00	Media	{"register":{"type":"fixed","value":671000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
348	.MENU	tld-menu	domain	758000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	758000.00	0.00	International	{"register":{"type":"fixed","value":680000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
319	.LIFE	tld-life	domain	904000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	904000.00	748000.00	Lifestyle	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
323	.LINK	tld-link	domain	233000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:40	\N	233000.00	175000.00	Tech	{"register":{"type":"fixed","value":175000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
350	.MODA	tld-moda	domain	894000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:36	\N	894000.00	855000.00	International	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
332	.LOVE	tld-love	domain	758000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	758000.00	564000.00	Lifestyle	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
100	.CA	tld-ca	domain	292000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:44	\N	292000.00	214000.00	International	{"register":{"type":"fixed","value":233000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
343	.MEDIA	tld-media	domain	1147000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	1147000.00	933000.00	Media	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
353	.MONEY	tld-money	domain	758000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	758000.00	680000.00	Finance	{"register":{"type":"fixed","value":680000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
344	.MEET	domain-meet	domain	295000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	International	\N
370	.ONE	tld-one	domain	603000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	603000.00	603000.00	International	\N
327	.LOAN	tld-loan	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	194000.00	117000.00	International	\N
377	.PARIS	tld-paris	domain	1302000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	1302000.00	0.00	International	\N
341	.MBA	tld-mba	domain	972000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	972000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
347	.MEN	tld-men	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	185000.00	117000.00	International	\N
351	.MOE	tld-moe	domain	348000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	348000.00	0.00	International	{"register":{"type":"fixed","value":292000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
336	.MAESTRO	tld-maestro	domain	0.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:51	\N	4839000.00	0.00	International	\N
329	.LOCKER	tld-locker	domain	1108000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:46	\N	1108000.00	913000.00	International	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
375	.ORGANIC	domain-organic	domain	996000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1254000.00	1254000.00	International	\N
811	.ARBITRATOR	tld-arbitrator	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	292000.00	0.00	General	\N
969	.SEXBLOG	tld-sexblog	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	583000.00	0.00	General	\N
431	.SCIENCE	tld-science	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	330000.00	253000.00	International	\N
432	.SECURITY	tld-security	domain	57329000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	57329000.00	45241000.00	International	{"register":{"type":"fixed","value":44659000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
419	.REVIEW	tld-review	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	306000.00	253000.00	International	\N
411	.REHAB	tld-rehab	domain	923000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	923000.00	748000.00	International	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
439	.SHOP	tld-shop	domain	952000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	952000.00	758000.00	Commerce	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1118	.XN--E77HHB	tld-xn--e77hhb	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	972000.00	0.00	General	\N
399	.PROMO	tld-promo	domain	651000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:52	\N	651000.00	515000.00	Commerce	{"register":{"type":"fixed","value":515000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
362	.NEW	tld-new	domain	11699000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	11699000.00	9503000.00	International	{"register":{"type":"fixed","value":9503000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
387	.PICS	tld-pics	domain	797000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	797000.00	641000.00	International	\N
438	.SHOES	tld-shoes	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	1594000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
424	.RODEO	tld-rodeo	domain	350000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:42	\N	350000.00	0.00	International	{"register":{"type":"fixed","value":272000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
389	.PINK	tld-pink	domain	612000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	612000.00	535000.00	International	{"register":{"type":"fixed","value":535000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
413	.RENTALS	tld-rentals	domain	1108000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1108000.00	913000.00	Real Estate	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
378	.PARTNERS	tld-partners	domain	1730000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	1730000.00	1458000.00	International	{"register":{"type":"fixed","value":1458000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
433	.SERVICES	tld-services	domain	1011000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	1011000.00	797000.00	Business	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
391	.PLACE	tld-place	domain	603000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:48	\N	603000.00	447000.00	International	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
407	.RADIO	domain-radio	domain	2765000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	2950000.00	2950000.00	International	\N
408	.REALESTATE	domain-realestate	domain	1494500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1845000.00	1845000.00	Real Estate	\N
396	.PRESS	tld-press	domain	1671000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	845000.00	1335000.00	Media	\N
394	.POKER	tld-poker	domain	1671000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	1671000.00	1399000.00	International	{"register":{"type":"fixed","value":1399000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
379	.PARTS	tld-parts	domain	894000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	894000.00	855000.00	International	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
406	.RACING	tld-racing	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	330000.00	253000.00	International	\N
428	.SARL	tld-sarl	domain	175000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:44	\N	175000.00	136000.00	International	{"register":{"type":"fixed","value":136000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
395	.PORN	tld-porn	domain	3012000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	3012000.00	2507000.00	International	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
402	.PROTECTION	tld-protection	domain	57329000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	57329000.00	44659000.00	International	{"register":{"type":"fixed","value":44659000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
421	.RICH	domain-rich	domain	30805500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	38507000.00	38507000.00	International	\N
423	.ROCKS	tld-rocks	domain	583000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:43	\N	583000.00	447000.00	International	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
380	.PARTY	tld-party	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	194000.00	117000.00	Lifestyle	\N
425	.RUN	tld-run	domain	700000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	700000.00	564000.00	International	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
468	.TECH	tld-tech	domain	1341000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	1147000.00	1164000.00	Tech	\N
456	.STUDY	tld-study	domain	991000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	991000.00	797000.00	Education	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
486	.TRAINING	tld-training	domain	1050000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1050000.00	855000.00	International	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
473	.THEATRE	tld-theatre	domain	12049000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	12049000.00	11641000.00	International	{"register":{"type":"fixed","value":11641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
454	.STREAM	tld-stream	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	194000.00	117000.00	International	\N
488	.TUBE	tld-tube	domain	661000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	661000.00	505000.00	International	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
485	.TRADING	tld-trading	domain	544000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:52	\N	544000.00	428000.00	Finance	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
450	.SOLUTIONS	tld-solutions	domain	816000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	816000.00	641000.00	Business	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
463	.SYSTEMS	tld-systems	domain	923000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	923000.00	729000.00	Tech	{"register":{"type":"fixed","value":729000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
469	.TECHNOLOGY	tld-technology	domain	739000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	739000.00	583000.00	Tech	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
484	.TRADE	tld-trade	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	194000.00	117000.00	Business	\N
483	.TOYS	tld-toys	domain	1603000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:36	\N	1603000.00	1331000.00	International	{"register":{"type":"fixed","value":1331000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
494	.VACATIONS	tld-vacations	domain	972000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	972000.00	797000.00	Location	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
490	.UK	tld-uk	domain	194000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	194000.00	0.00	Location	{"register":{"type":"fixed","value":146000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
441	.SHOW	tld-show	domain	933000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	933000.00	855000.00	Media	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
460	.SUPPLY	tld-supply	domain	651000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	651000.00	535000.00	International	{"register":{"type":"fixed","value":535000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
462	.SURGERY	tld-surgery	domain	1341000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	1341000.00	1127000.00	International	{"register":{"type":"fixed","value":1127000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
495	.VC	tld-vc	domain	816000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	816000.00	641000.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
457	.STYLE	tld-style	domain	972000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	972000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
470	.TEL	tld-tel	domain	311000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:50	\N	311000.00	214000.00	International	{"register":{"type":"fixed","value":214000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
451	.SOY	tld-soy	domain	777000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	777000.00	0.00	International	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
448	.SOFTWARE	tld-software	domain	1108000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	1108000.00	855000.00	Tech	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
481	.TOURS	tld-tours	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	1594000.00	1283000.00	Location	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
476	.TIRES	tld-tires	domain	2157000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	2157000.00	1710000.00	International	{"register":{"type":"fixed","value":1710000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
466	.TAXI	tld-taxi	domain	1360000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	1360000.00	1283000.00	International	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
596	.MIAMI	tld-miami	domain	603000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:51	\N	603000.00	486000.00	General	{"register":{"type":"fixed","value":486000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
529	.NET.CN	tld-netcn	domain	0.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:53	\N	467000.00	0.00	General	\N
11	.0Z	tld-0z	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:57	\N	447000.00	0.00	Numeric	\N
287	.IN	tld-in	domain	233000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:30	\N	233000.00	194000.00	International	\N
530	.NU	tld-nu	domain	0.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:53	\N	776000.00	0.00	General	\N
531	.ORG.CN	tld-orgcn	domain	0.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:53	\N	467000.00	0.00	General	\N
505	.VOTE	tld-vote	domain	2332000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	2332000.00	1866000.00	International	{"register":{"type":"fixed","value":1866000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
489	.TV	tld-tv	domain	797000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:45	\N	797000.00	564000.00	Media	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
51	.ASIA	tld-asia	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:31	\N	369000.00	282000.00	Location	{"register":{"type":"fixed","value":282000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
520	.XBOX	domain-xbox	domain	1845000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1845000.00	1845000.00	International	\N
342	.ME	tld-me	domain	467000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:45	\N	467000.00	350000.00	Popular	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
521	.XYZ	tld-xyz	domain	418000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:42	\N	418000.00	342000.00	Popular	\N
524	.ZZ	domain-zz	domain	1088500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1088500.00	1088500.00	International	\N
515	.WINE	tld-wine	domain	1477000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	1477000.00	1224000.00	International	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
525	.4sale	domain-4sale	domain	738000.00	yr	\N	f	2025-12-24 19:39:56	2025-12-24 19:39:56	\N	369000.00	369000.00	Numeric	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":null,"type":"none","value":"0","label":null},"biennially":{"custom_price":null,"type":"none","value":"0","label":null},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
517	.WORKS	tld-works	domain	1011000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	1011000.00	797000.00	Business	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
4	Shared Starter	shared-starter	hosting	90500.00	mo	\N	f	2025-12-24 19:07:21	2025-12-24 19:46:24	\N	0.00	0.00	General	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":"902000","type":"percent","value":"59","label":"Off 1st Year"},"biennially":{"custom_price":"1695500","type":"percent","value":"68","label":"Off 2 Year"},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
5	Shared Business	shared-business	hosting	127000.00	mo	Best Value	f	2025-12-24 19:07:21	2025-12-24 19:48:40	\N	0.00	0.00	General	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":"1381500","type":"percent","value":"57","label":"Off 1st Year"},"biennially":{"custom_price":"2414500","type":"percent","value":"67","label":"Off 2 Year"},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
6	Shared Premium	shared-premium	hosting	182500.00	mo	\N	f	2025-12-24 19:07:21	2025-12-24 19:50:21	\N	0.00	0.00	General	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":"2082500","type":"percent","value":"50","label":"Off 1st Year"},"biennially":{"custom_price":"4149000","type":"percent","value":"55","label":"Off 2 Year"},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
597	.SO	tld-so	domain	1341000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	1341000.00	2507000.00	General	{"register":{"type":"fixed","value":1263000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
503	.VISION	tld-vision	domain	1166000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:35	\N	1166000.00	933000.00	International	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
502	.VIP	tld-vip	domain	408000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:49	\N	214000.00	117000.00	Lifestyle	\N
514	.WIN	tld-win	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	194000.00	117000.00	International	\N
598	.CO.IN	tld-coin	domain	185000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:51	\N	185000.00	185000.00	General	\N
133	.CO	tld-co	domain	884000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:30	\N	884000.00	748000.00	Popular	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
510	.WEBCAM	tld-webcam	domain	505000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	350000.00	253000.00	International	\N
516	.WORK	tld-work	domain	350000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:44	\N	350000.00	0.00	Business	{"register":{"type":"fixed","value":272000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
526	.CC	tld-cc	domain	272000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-05 07:01:36	\N	272000.00	214000.00	General	{"register":{"type":"fixed","value":214000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
511	.WEBSITE	tld-website	domain	408000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:44	\N	408000.00	447000.00	Tech	{"register":{"type":"fixed","value":35000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
132	.CN	tld-cn	domain	0.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:53	\N	467000.00	0.00	Location	\N
199	.EQUIPMENT	tld-equipment	domain	641000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:32	\N	641000.00	583000.00	International	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
568	.GB.NET	tld-gbnet	domain	855000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	855000.00	680000.00	General	{"register":{"type":"fixed","value":680000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
579	.ORG.VC	tld-orgvc	domain	816000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	816000.00	641000.00	General	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
541	.VIAJES	tld-viajes	domain	1127000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:33	\N	1127000.00	855000.00	General	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
574	.MEX.COM	tld-mexcom	domain	340000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-05 07:01:48	\N	340000.00	301000.00	General	{"register":{"type":"fixed","value":301000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
538	.MAISON	tld-maison	domain	1360000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:34	\N	1360000.00	1186000.00	General	{"register":{"type":"fixed","value":1186000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
581	.SYDNEY	tld-sydney	domain	1069000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-06 07:01:51	\N	1069000.00	875000.00	General	{"register":{"type":"fixed","value":875000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
536	.DE.COM	tld-decom	domain	554000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-05 07:01:38	\N	554000.00	418000.00	General	{"register":{"type":"fixed","value":418000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
404	.PW	tld-pw	domain	467000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:32	\N	398000.00	402000.00	International	\N
519	.WTF	tld-wtf	domain	962000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:37	\N	962000.00	748000.00	International	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
508	.VOYAGE	tld-voyage	domain	1438000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1438000.00	1205000.00	Location	{"register":{"type":"fixed","value":1205000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
478	.TOKYO	tld-tokyo	domain	486000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:36	\N	486000.00	0.00	Location	{"register":{"type":"fixed","value":330000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
384	.PHOTO	tld-photo	domain	797000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	797000.00	622000.00	International	{"register":{"type":"fixed","value":622000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
572	.HU.NET	tld-hunet	domain	875000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	875000.00	641000.00	General	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
575	.CO.COM	tld-cocom	domain	700000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:35	\N	700000.00	505000.00	General	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
545	.HIPHOP	tld-hiphop	domain	661000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-07 07:01:39	\N	661000.00	505000.00	General	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
339	.MARKET	tld-market	domain	1088000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	1088000.00	913000.00	Commerce	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
585	.CAM	tld-cam	domain	447000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:44	\N	447000.00	389000.00	General	{"register":{"type":"fixed","value":194000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
557	.REISE	tld-reise	domain	2488000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:41	\N	2488000.00	2002000.00	General	{"register":{"type":"fixed","value":2002000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
401	.PROPERTY	tld-property	domain	3148000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	3148000.00	2507000.00	Real Estate	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
547	.DESI	tld-desi	domain	447000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-05 07:01:44	\N	447000.00	0.00	General	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
563	.ZA.COM	tld-zacom	domain	8998000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:42	\N	8998000.00	6996000.00	General	{"register":{"type":"fixed","value":6996000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
559	.EU.COM	tld-eucom	domain	583000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-05 07:01:48	\N	583000.00	418000.00	General	{"register":{"type":"fixed","value":418000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
587	.MX	tld-mx	domain	1147000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:44	\N	1147000.00	913000.00	General	{"register":{"type":"fixed","value":816000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
565	.SA.COM	tld-sacom	domain	9678000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:42	\N	9678000.00	6996000.00	General	{"register":{"type":"fixed","value":6996000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
634	.LIFESTYLE	tld-lifestyle	domain	952000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	952000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
642	.IT.COM	tld-itcom	domain	758000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	758000.00	641000.00	General	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
608	.OH	tld-oh	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:53	\N	292000.00	0.00	General	\N
632	.DIY	tld-diy	domain	1011000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:52	\N	1011000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
652	.CAT	tld-cat	domain	758000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	758000.00	758000.00	General	\N
648	.FAST	tld-fast	domain	700000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:52	\N	700000.00	700000.00	General	\N
651	.BARCELONA	tld-barcelona	domain	758000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	758000.00	758000.00	General	\N
606	.ELITE	tld-elite	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:54	\N	175000.00	0.00	General	\N
624	.DAD	tld-dad	domain	330000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	330000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
649	.TALK	tld-talk	domain	913000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:47	\N	913000.00	913000.00	General	\N
600	.HAIR	tld-hair	domain	428000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:51	\N	428000.00	342000.00	General	\N
654	.LATINO	tld-latino	domain	525000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	525000.00	447000.00	General	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
607	.ILL	tld-ill	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:54	\N	175000.00	0.00	General	\N
604	.YACHTS	tld-yachts	domain	428000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:52	\N	428000.00	342000.00	General	\N
657	.NET.PE	tld-netpe	domain	1905000.00	mo	\N	f	2026-08-14 13:34:47	2026-09-07 07:01:31	\N	1905000.00	2254000.00	General	{"register":{"type":"fixed","value":1730000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
665	.LI	tld-li	domain	389000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-06 07:01:45	\N	389000.00	0.00	General	{"register":{"type":"fixed","value":292000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
628	.DEALER	tld-dealer	domain	45630000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	45630000.00	40772000.00	General	{"register":{"type":"fixed","value":40772000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
609	.OO	tld-oo	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:53	\N	292000.00	0.00	General	\N
618	.KIDS	tld-kids	domain	583000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:52	\N	583000.00	447000.00	General	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
601	.FORUM	tld-forum	domain	972000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:51	\N	972000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
614	.SAAS	tld-saas	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:53	\N	292000.00	0.00	General	\N
610	.OOT	tld-oot	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:54	\N	175000.00	0.00	General	\N
569	.GR.COM	tld-grcom	domain	428000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-06 07:01:50	\N	428000.00	292000.00	General	{"register":{"type":"fixed","value":292000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
611	.ORB	tld-orb	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:54	\N	175000.00	0.00	General	\N
662	.ORG.ES	tld-orges	domain	408000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-07 07:01:32	\N	408000.00	0.00	General	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
660	.COM.ES	tld-comes	domain	505000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-07 07:01:32	\N	505000.00	0.00	General	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
636	.VANA	tld-vana	domain	48545000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	48545000.00	44659000.00	General	{"register":{"type":"fixed","value":44659000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
640	.NET.IM	tld-netim	domain	243000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	243000.00	0.00	General	{"register":{"type":"fixed","value":165000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
646	.SPOT	tld-spot	domain	622000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	622000.00	505000.00	General	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
647	.CV	tld-cv	domain	292000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:52	\N	292000.00	389000.00	General	\N
616	.RSVP	tld-rsvp	domain	330000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	330000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
615	.SOX	tld-sox	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:54	\N	175000.00	0.00	General	\N
445	.SKIN	tld-skin	domain	428000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	428000.00	342000.00	International	\N
612	.P	tld-p	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:47	\N	680000.00	0.00	General	\N
622	.ZIP	tld-zip	domain	309000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:52	\N	309000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
677	.C	tld-c	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	389000.00	0.00	General	\N
678	.CABINS	tld-cabins	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:53	\N	778000.00	0.00	General	\N
671	.AUGMENTED	tld-augmented	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	311000.00	0.00	General	\N
679	.CARDCOLLECTOR	tld-cardcollector	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:53	\N	156000.00	0.00	General	\N
673	.BEACH	tld-beach	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	389000.00	0.00	General	\N
689	.DEFI	tld-defi	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:53	\N	2333000.00	0.00	General	\N
688	.DAN	tld-dan	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	505000.00	0.00	General	\N
681	.COFFEES	tld-coffees	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	195000.00	0.00	General	\N
685	.CONSULTANCY	tld-consultancy	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	389000.00	0.00	General	\N
692	.DIVA	tld-diva	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	389000.00	0.00	General	\N
697	.EDM	tld-edm	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	273000.00	0.00	General	\N
684	.COMMERCE	tld-commerce	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	3848000.00	0.00	General	\N
690	.DEGEN	tld-degen	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	389000.00	0.00	General	\N
703	.EXT	tld-ext	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	447000.00	0.00	General	\N
699	.EPORN	tld-eporn	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	594000.00	0.00	General	\N
675	.BOREDAPES	tld-boredapes	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	317000.00	0.00	General	\N
711	.HILL	tld-hill	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	175000.00	0.00	General	\N
691	.DEN	tld-den	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	622000.00	0.00	General	\N
693	.DOGE	tld-doge	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:53	\N	156000.00	0.00	General	\N
707	.GER	tld-ger	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
701	.ESTATES	tld-estates	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	447000.00	0.00	General	\N
680	.CITIZENSHIP	tld-citizenship	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	389000.00	0.00	General	\N
705	.FE	tld-fe	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
709	.GUEY	tld-guey	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	195000.00	0.00	General	\N
702	.EWALLET	tld-ewallet	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	194000.00	0.00	General	\N
710	.HACK	tld-hack	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	972000.00	0.00	General	\N
708	.GREATOFFERS	tld-greatoffers	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	447000.00	0.00	General	\N
694	.DOOKIE	tld-dookie	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	350000.00	0.00	General	\N
704	.EZ	tld-ez	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	389000.00	0.00	General	\N
670	.API	tld-api	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	389000.00	0.00	General	\N
605	.CREATOR	tld-creator	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:53	\N	292000.00	0.00	General	\N
712	.HIRE	tld-hire	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	972000.00	0.00	General	\N
706	.FOOT	tld-foot	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	389000.00	0.00	General	\N
700	.ERO	tld-ero	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-08-22 07:01:24	\N	117000.00	0.00	General	\N
713	.HOLDING	tld-holding	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	253000.00	0.00	General	\N
714	.HOLIDAYS	tld-holidays	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	1944000.00	0.00	General	\N
405	.QUEST	tld-quest	domain	428000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	428000.00	342000.00	International	\N
717	.INNOVATOR	tld-innovator	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	195000.00	0.00	General	\N
674	.BEEF	tld-beef	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:47	\N	1944000.00	0.00	General	\N
719	.ISLAND	tld-island	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	1050000.00	0.00	General	\N
542	.XN--3DS443G	tld-xn--3ds443g	domain	0.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:53	\N	700000.00	0.00	General	\N
716	.INFLUENCER	tld-influencer	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	1944000.00	0.00	General	\N
672	.BAKES	tld-bakes	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	195000.00	0.00	General	\N
602	.MOTORCYCLES	tld-motorcycles	domain	428000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:52	\N	428000.00	342000.00	General	\N
667	.SUBSTACK	tld-substack	domain	603000.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:52	\N	603000.00	0.00	General	\N
698	.EGAME	tld-egame	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	311000.00	0.00	General	\N
669	.APARTMENT	tld-apartment	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:53	\N	1167000.00	0.00	General	\N
668	.AOTEAROA	tld-aotearoa	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:54	\N	195000.00	0.00	General	\N
682	.COMIC	tld-comic	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	777000.00	0.00	General	\N
676	.BROKERS	tld-brokers	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:47	\N	3887000.00	0.00	General	\N
686	.CRAZY	tld-crazy	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:53	\N	584000.00	0.00	General	\N
696	.ECONOMY	tld-economy	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	972000.00	0.00	General	\N
695	.DWEB	tld-dweb	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	972000.00	0.00	General	\N
720	.ISM	tld-ism	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	1167000.00	0.00	General	\N
650	.YOU	tld-you	domain	544000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	544000.00	544000.00	General	\N
613	.PGP	tld-pgp	domain	0.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:53	\N	292000.00	0.00	General	\N
683	.COMICS	tld-comics	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	194000.00	0.00	General	\N
687	.CREATIONS	tld-creations	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:53	\N	778000.00	0.00	General	\N
718	.INY	tld-iny	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	739000.00	0.00	General	\N
715	.HOTELGUIDE	tld-hotelguide	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	195000.00	0.00	General	\N
666	.FAM	tld-fam	domain	778000.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:52	\N	778000.00	778000.00	General	\N
735	.MENT	tld-ment	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	292000.00	0.00	General	\N
734	.MANSION	tld-mansion	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	311000.00	0.00	General	\N
780	.ULTIMATE	tld-ultimate	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	3848000.00	0.00	General	\N
722	.IURL	tld-iurl	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	389000.00	0.00	General	\N
738	.MOONING	tld-mooning	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	350000.00	0.00	General	\N
741	.MYCO	tld-myco	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	262000.00	0.00	General	\N
748	.OIN	tld-oin	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
742	.MYURL	tld-myurl	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
744	.NFTCARTEL	tld-nftcartel	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
779	.UGE	tld-uge	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	311000.00	0.00	General	\N
749	.ONCAM	tld-oncam	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	156000.00	0.00	General	\N
752	.PICTURE	tld-picture	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
764	.SSL	tld-ssl	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	292000.00	0.00	General	\N
757	.ROGAN	tld-rogan	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
755	.PROJECT	tld-project	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
754	.PREMIUM	tld-premium	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	972000.00	0.00	General	\N
775	.TROLL	tld-troll	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	117000.00	0.00	General	\N
777	.TX	tld-tx	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	389000.00	0.00	General	\N
758	.ROW	tld-row	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	273000.00	0.00	General	\N
756	.REKT	tld-rekt	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	350000.00	0.00	General	\N
751	.PAL	tld-pal	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
759	.SATS	tld-sats	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
763	.SRC	tld-src	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	700000.00	0.00	General	\N
765	.STARTUP	tld-startup	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
789	.YEAR	tld-year	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	972000.00	0.00	General	\N
770	.TER	tld-ter	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	292000.00	0.00	General	\N
784	.VLOG	tld-vlog	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	389000.00	0.00	General	\N
730	.LNX	tld-lnx	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	97000.00	0.00	General	\N
769	.TEFI	tld-tefi	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	156000.00	0.00	General	\N
772	.TNI	tld-tni	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	117000.00	0.00	General	\N
771	.THENERD	tld-thenerd	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
729	.LEAN	tld-lean	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	1167000.00	0.00	General	\N
768	.TECK	tld-teck	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
767	.SWAPZ	tld-swapz	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-08-21 07:01:37	\N	29000.00	0.00	General	\N
781	.USE	tld-use	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	97000.00	0.00	General	\N
783	.VISIT	tld-visit	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	389000.00	0.00	General	\N
786	.WEBDESIGNER	tld-webdesigner	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	292000.00	0.00	General	\N
723	.IZE	tld-ize	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
743	.NEARME	tld-nearme	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	661000.00	0.00	General	\N
728	.KNOWLEDGE	tld-knowledge	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	195000.00	0.00	General	\N
737	.MKE	tld-mke	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	972000.00	0.00	General	\N
725	.JOKER	tld-joker	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	739000.00	0.00	General	\N
788	.XXXX	tld-xxxx	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	350000.00	0.00	General	\N
762	.SQUIRTFIESTA	tld-squirtfiesta	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	195000.00	0.00	General	\N
740	.MYCARD	tld-mycard	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
727	.JS	tld-js	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
724	.JOB	tld-job	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	1167000.00	0.00	General	\N
732	.LOVESYOU	tld-lovesyou	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	117000.00	0.00	General	\N
746	.NOM	tld-nom	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	584000.00	0.00	General	\N
736	.MINED	tld-mined	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
731	.LOGO	tld-logo	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	564000.00	0.00	General	\N
747	.OFTEN	tld-often	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	622000.00	0.00	General	\N
745	.NIL	tld-nil	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	603000.00	0.00	General	\N
761	.SHOT	tld-shot	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	1167000.00	0.00	General	\N
773	.TOKEN	tld-token	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	583000.00	0.00	General	\N
776	.TUBER	tld-tuber	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	778000.00	0.00	General	\N
753	.PIX	tld-pix	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	828000.00	0.00	General	\N
766	.STREAMER	tld-streamer	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	156000.00	0.00	General	\N
778	.UD	tld-ud	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	778000.00	0.00	General	\N
782	.VALLEY	tld-valley	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	778000.00	0.00	General	\N
739	.MTL	tld-mtl	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:56	\N	389000.00	0.00	General	\N
750	.ONLINENEWS	tld-onlinenews	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	156000.00	0.00	General	\N
785	.WAVE	tld-wave	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	700000.00	0.00	General	\N
726	.JPGS	tld-jpgs	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	778000.00	0.00	General	\N
787	.XR	tld-xr	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	389000.00	0.00	General	\N
812	.ARTESANAL	tld-artesanal	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	583000.00	0.00	General	\N
796	.DOJO	tld-dojo	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-08-21 07:01:37	\N	78000.00	0.00	General	\N
808	.AMG	tld-amg	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	447000.00	0.00	General	\N
809	.AMOR	tld-amor	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	875000.00	0.00	General	\N
814	.ATC	tld-atc	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	272000.00	0.00	General	\N
819	.BATCH	tld-batch	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	447000.00	0.00	General	\N
830	.CARES	tld-cares	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	1438000.00	0.00	General	\N
831	.CATGIRL	tld-catgirl	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	739000.00	0.00	General	\N
822	.BOB	tld-bob	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	292000.00	0.00	General	\N
829	.C4	tld-c4	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	661000.00	0.00	General	\N
824	.BQW	tld-bqw	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	156000.00	0.00	General	\N
817	.BAAS	tld-baas	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	894000.00	0.00	General	\N
836	.CLIENT	tld-client	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
826	.BTT	tld-btt	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	156000.00	0.00	General	\N
823	.BOOKED	tld-booked	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
834	.CKQ	tld-ckq	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	214000.00	0.00	General	\N
840	.CM3	tld-cm3	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	97000.00	0.00	General	\N
850	.CONF	tld-conf	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	3090000.00	0.00	General	\N
832	.CAUSES	tld-causes	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	564000.00	0.00	General	\N
845	.COMPLETE	tld-complete	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	311000.00	0.00	General	\N
833	.CISM	tld-cism	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	447000.00	0.00	General	\N
835	.CLC	tld-clc	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	311000.00	0.00	General	\N
825	.BREWERY	tld-brewery	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	894000.00	0.00	General	\N
827	.BUDDHIST	tld-buddhist	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	311000.00	0.00	General	\N
853	.CORPORATION	tld-corporation	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	2896000.00	0.00	General	\N
839	.CLOUDBOT	tld-cloudbot	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	447000.00	0.00	General	\N
838	.CLIQ	tld-cliq	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	447000.00	0.00	General	\N
854	.CREATIVITY	tld-creativity	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	272000.00	0.00	General	\N
841	.CN3	tld-cn3	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	97000.00	0.00	General	\N
807	.ALTO	tld-alto	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	311000.00	0.00	General	\N
843	.COINNET	tld-coinnet	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	447000.00	0.00	General	\N
846	.COMPUTERS	tld-computers	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	1730000.00	0.00	General	\N
790	.YO	tld-yo	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	117000.00	0.00	General	\N
851	.CONNECTORS	tld-connectors	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	311000.00	0.00	General	\N
799	.4YOU	tld-4you	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	447000.00	0.00	General	\N
803	.ADVISOR	tld-advisor	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	2896000.00	0.00	General	\N
855	.CREW	tld-crew	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	564000.00	0.00	General	\N
798	.GOTH	tld-goth	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	311000.00	0.00	General	\N
805	.AFZ	tld-afz	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	146000.00	0.00	General	\N
857	.CRYP	tld-cryp	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:59	\N	894000.00	0.00	General	\N
792	.YUMMY	tld-yummy	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	584000.00	0.00	General	\N
800	.8S	tld-8s	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	253000.00	0.00	General	\N
847	.CONCISE	tld-concise	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	583000.00	0.00	General	\N
816	.B2B	tld-b2b	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	1477000.00	0.00	General	\N
794	.ZEN	tld-zen	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	389000.00	0.00	General	\N
815	.ATWORK	tld-atwork	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
797	.RESOURCES	tld-resources	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	447000.00	0.00	General	\N
801	.ABO	tld-abo	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	214000.00	0.00	General	\N
802	.ABOUTME	tld-aboutme	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	515000.00	0.00	General	\N
828	.BYN	tld-byn	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	253000.00	0.00	General	\N
820	.BEM	tld-bem	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	272000.00	0.00	General	\N
858	.CRYPTOGAMER	tld-cryptogamer	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:59	\N	97000.00	0.00	General	\N
837	.CLIENTS	tld-clients	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	1769000.00	0.00	General	\N
842	.CO3	tld-co3	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	156000.00	0.00	General	\N
821	.BIZDATA	tld-bizdata	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	389000.00	0.00	General	\N
804	.AFAM	tld-afam	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
849	.CONDUCTOR	tld-conductor	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	350000.00	0.00	General	\N
848	.CONDUCT	tld-conduct	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	272000.00	0.00	General	\N
856	.CROATIA	tld-croatia	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	894000.00	0.00	General	\N
793	.YZX	tld-yzx	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:57	\N	389000.00	0.00	General	\N
806	.AGUA	tld-agua	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
813	.ASSURANCES	tld-assurances	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
852	.CORK	tld-cork	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	875000.00	0.00	General	\N
872	.DOMA	tld-doma	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	583000.00	0.00	General	\N
887	.FCB	tld-fcb	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	311000.00	0.00	General	\N
883	.EXU	tld-exu	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	194000.00	0.00	General	\N
875	.DVD	tld-dvd	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
880	.ETERNITY	tld-eternity	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	894000.00	0.00	General	\N
910	.HACKATHON	tld-hackathon	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	1477000.00	0.00	General	\N
884	.EYECARE	tld-eyecare	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
881	.ETICKETS	tld-etickets	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
890	.FIAT2BTC	tld-fiat2btc	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
886	.FAQS	tld-faqs	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	3518000.00	0.00	General	\N
896	.FOLLOW	tld-follow	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	156000.00	0.00	General	\N
888	.FELLOWSHIP	tld-fellowship	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
906	.GIC	tld-gic	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
893	.FINANCIALNEWS	tld-financialnews	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
899	.FUA	tld-fua	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	253000.00	0.00	General	\N
894	.FINDME	tld-findme	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	408000.00	0.00	General	\N
911	.HAE	tld-hae	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
889	.FIA	tld-fia	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
892	.FILTERS	tld-filters	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
873	.DOWN	tld-down	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	1147000.00	0.00	General	\N
903	.GETHIGH	tld-gethigh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	156000.00	0.00	General	\N
895	.FMW	tld-fmw	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	146000.00	0.00	General	\N
902	.GADGET	tld-gadget	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	1730000.00	0.00	General	\N
912	.HB	tld-hb	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	311000.00	0.00	General	\N
922	.INH	tld-inh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
925	.IUH	tld-iuh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
865	.DEAN	tld-dean	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	292000.00	0.00	General	\N
869	.DIRECTIVE	tld-directive	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	311000.00	0.00	General	\N
897	.FORALL	tld-forall	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	389000.00	0.00	General	\N
905	.GETWELL	tld-getwell	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	447000.00	0.00	General	\N
908	.GYC	tld-gyc	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	272000.00	0.00	General	\N
913	.HEH	tld-heh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
921	.INFORMATION	tld-information	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	311000.00	0.00	General	\N
917	.HPP	tld-hpp	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
904	.GETREAL	tld-getreal	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	311000.00	0.00	General	\N
915	.HEM	tld-hem	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	311000.00	0.00	General	\N
870	.DISCUSSION	tld-discussion	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	292000.00	0.00	General	\N
914	.HELPDESK	tld-helpdesk	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	894000.00	0.00	General	\N
923	.INTRO	tld-intro	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	311000.00	0.00	General	\N
861	.DAIS	tld-dais	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	292000.00	0.00	General	\N
926	.JOV	tld-jov	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
924	.IOI	tld-ioi	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	292000.00	0.00	General	\N
863	.DATAMINING	tld-datamining	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
871	.DOLLS	tld-dolls	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	1477000.00	0.00	General	\N
866	.DEVELOPMENT	tld-development	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	2896000.00	0.00	General	\N
878	.EMJ	tld-emj	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	97000.00	0.00	General	\N
900	.FWD	tld-fwd	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	894000.00	0.00	General	\N
867	.DIDS	tld-dids	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
862	.DAMN	tld-damn	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	1283000.00	0.00	General	\N
864	.DAYTRADE	tld-daytrade	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	603000.00	0.00	General	\N
874	.DUCKTAPE	tld-ducktape	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
868	.DILATE	tld-dilate	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	311000.00	0.00	General	\N
879	.ENGAGED	tld-engaged	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	1769000.00	0.00	General	\N
882	.EVENT	tld-event	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	1749000.00	0.00	General	\N
859	.CRYPTOSERVICE	tld-cryptoservice	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-08-21 07:01:37	\N	78000.00	0.00	General	\N
901	.GAD	tld-gad	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	194000.00	0.00	General	\N
877	.ELECTRONICS	tld-electronics	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	1147000.00	0.00	General	\N
907	.GRANDMASTER	tld-grandmaster	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	272000.00	0.00	General	\N
885	.FAK	tld-fak	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	194000.00	0.00	General	\N
918	.HSU	tld-hsu	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	253000.00	0.00	General	\N
919	.I1	tld-i1	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	447000.00	0.00	General	\N
909	.GZP	tld-gzp	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	214000.00	0.00	General	\N
916	.HOLIDAYRENTAL	tld-holidayrental	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:00	\N	719000.00	0.00	General	\N
898	.FORE	tld-fore	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	272000.00	0.00	General	\N
994	.W8	tld-w8	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-14 13:34:51	\N	39000.00	0.00	General	\N
978	.SPECS	tld-specs	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
941	.MEDIATOR	tld-mediator	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	292000.00	0.00	General	\N
948	.NAPAVALLEY	tld-napavalley	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
946	.MYO	tld-myo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	253000.00	0.00	General	\N
949	.NOUNS	tld-nouns	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:02	\N	253000.00	0.00	General	\N
953	.OHMY	tld-ohmy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:03	\N	311000.00	0.00	General	\N
965	.RICAN	tld-rican	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	156000.00	0.00	General	\N
951	.NUK	tld-nuk	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:02	\N	243000.00	0.00	General	\N
952	.ODA	tld-oda	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:02	\N	272000.00	0.00	General	\N
975	.SOLUTION	tld-solution	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	2896000.00	0.00	General	\N
958	.PERFORMER	tld-performer	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	467000.00	0.00	General	\N
970	.SHARING	tld-sharing	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	1477000.00	0.00	General	\N
964	.QUEENS	tld-queens	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	311000.00	0.00	General	\N
957	.PAID	tld-paid	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:03	\N	311000.00	0.00	General	\N
972	.SIG	tld-sig	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
980	.TAXFREE	tld-taxfree	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
983	.TRANS	tld-trans	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	2935000.00	0.00	General	\N
974	.SNIFF	tld-sniff	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	777000.00	0.00	General	\N
988	.UNDERGROUND	tld-underground	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	894000.00	0.00	General	\N
977	.SOUTHAFRICAN	tld-southafrican	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	262000.00	0.00	General	\N
966	.RPGS	tld-rpgs	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
976	.SOS	tld-sos	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	1477000.00	0.00	General	\N
971	.SHOPPINGCART	tld-shoppingcart	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
973	.SIMPLICITY	tld-simplicity	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
982	.TEENAGER	tld-teenager	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	894000.00	0.00	General	\N
967	.RUNS	tld-runs	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	156000.00	0.00	General	\N
968	.RURAL	tld-rural	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	272000.00	0.00	General	\N
991	.UNLOCK	tld-unlock	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	1477000.00	0.00	General	\N
989	.UNDERWORLD	tld-underworld	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
934	.L33T	tld-l33t	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	398000.00	0.00	General	\N
985	.TRICKS	tld-tricks	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
986	.TURTLES	tld-turtles	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	311000.00	0.00	General	\N
990	.UNIT	tld-unit	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	311000.00	0.00	General	\N
943	.MEE	tld-mee	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
947	.NAH	tld-nah	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
931	.KICKS	tld-kicks	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
927	.JUB	tld-jub	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	156000.00	0.00	General	\N
992	.UUI	tld-uui	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	311000.00	0.00	General	\N
932	.KINETIC	tld-kinetic	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	272000.00	0.00	General	\N
944	.MISSION	tld-mission	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	855000.00	0.00	General	\N
993	.UZR	tld-uzr	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	146000.00	0.00	General	\N
963	.PUN	tld-pun	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	311000.00	0.00	General	\N
995	.WASABI	tld-wasabi	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	894000.00	0.00	General	\N
937	.LINGO	tld-lingo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-04 07:02:32	\N	107000.00	0.00	General	\N
936	.LIKEAPRO	tld-likeapro	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	894000.00	0.00	General	\N
950	.NPM	tld-npm	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	292000.00	0.00	General	\N
962	.PUI	tld-pui	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
938	.LJB	tld-ljb	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	156000.00	0.00	General	\N
933	.KNIGHT	tld-knight	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	311000.00	0.00	General	\N
945	.MONTAGE	tld-montage	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	311000.00	0.00	General	\N
929	.KCX	tld-kcx	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	233000.00	0.00	General	\N
935	.LARS	tld-lars	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	175000.00	0.00	General	\N
942	.MEDICO	tld-medico	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:01	\N	272000.00	0.00	General	\N
984	.TREKKING	tld-trekking	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	894000.00	0.00	General	\N
954	.OOF	tld-oof	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	2196000.00	0.00	General	\N
940	.LYF	tld-lyf	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	603000.00	0.00	General	\N
959	.PIZ	tld-piz	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
960	.PLAZA	tld-plaza	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:03	\N	447000.00	0.00	General	\N
987	.UMO	tld-umo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	146000.00	0.00	General	\N
939	.LOV	tld-lov	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	467000.00	0.00	General	\N
955	.OSLO	tld-oslo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:56	\N	292000.00	0.00	General	\N
979	.SUS	tld-sus	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:04	\N	311000.00	0.00	General	\N
956	.OUN	tld-oun	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:50	\N	194000.00	0.00	General	\N
1007	.CYPRUS	tld-cyprus	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	311000.00	0.00	General	\N
1030	.WL	tld-wl	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:06	\N	146000.00	0.00	General	\N
1016	.WC	tld-wc	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	311000.00	0.00	General	\N
1017	.PEST	tld-pest	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1021	.ELECT	tld-elect	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1012	.GROW	tld-grow	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1009	.HAITI	tld-haiti	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	311000.00	0.00	General	\N
1020	.LAWOFFICE	tld-lawoffice	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1022	.SEMI	tld-semi	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1031	.PPP	tld-ppp	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:06	\N	97000.00	0.00	General	\N
1019	.PLY	tld-ply	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1024	.FLAT	tld-flat	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	311000.00	0.00	General	\N
1027	.CLIC	tld-clic	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	330000.00	0.00	General	\N
1023	.PREMIO	tld-premio	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	58000.00	0.00	General	\N
1037	.DG	tld-dg	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1028	.PLACES	tld-places	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:06	\N	447000.00	0.00	General	\N
997	.SALES	tld-sales	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	447000.00	0.00	General	\N
1015	.UNIVERSE	tld-universe	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	311000.00	0.00	General	\N
1029	.CYCLE	tld-cycle	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:06	\N	447000.00	0.00	General	\N
1039	.DY	tld-dy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1036	.RH	tld-rh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1040	.EP	tld-ep	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1044	.IB	tld-ib	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1034	.GUIDANCE	tld-guidance	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-22 07:01:26	\N	117000.00	0.00	General	\N
1042	.FW	tld-fw	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1010	.DECENT	tld-decent	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	146000.00	0.00	General	\N
1032	.MYPROXY	tld-myproxy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-21 07:01:38	\N	78000.00	0.00	General	\N
1048	.JA	tld-ja	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1043	.HF	tld-hf	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1049	.JY	tld-jy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1050	.KF	tld-kf	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1051	.KL	tld-kl	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1052	.KS	tld-ks	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1053	.KV	tld-kv	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1054	.LO	tld-lo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1055	.LW	tld-lw	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1056	.LZ	tld-lz	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1057	.OB	tld-ob	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1058	.OQ	tld-oq	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1059	.OT	tld-ot	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1061	.PV	tld-pv	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1060	.MVO	tld-mvo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:06	\N	214000.00	0.00	General	\N
1063	.QG	tld-qg	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1026	.HORNY	tld-horny	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	1477000.00	0.00	General	\N
1062	.PZ	tld-pz	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
999	.TUTORIAL	tld-tutorial	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
998	.WEBSITES	tld-websites	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	447000.00	0.00	General	\N
1014	.FL3X	tld-fl3x	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	97000.00	0.00	General	\N
1006	.DISCOUNTS	tld-discounts	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1000	.SAY	tld-say	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1008	.RESEARCHER	tld-researcher	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	156000.00	0.00	General	\N
1013	.VIEWER	tld-viewer	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
1004	.WON	tld-won	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1003	.DOWNLOADS	tld-downloads	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	447000.00	0.00	General	\N
1005	.NOTES	tld-notes	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:05	\N	447000.00	0.00	General	\N
1033	.DOGECOIN	tld-dogecoin	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-21 07:01:38	\N	78000.00	0.00	General	\N
1047	.IW	tld-iw	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1011	.SDS	tld-sds	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	603000.00	0.00	General	\N
1018	.PIER	tld-pier	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1046	.IK	tld-ik	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1001	.PRICES	tld-prices	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	292000.00	0.00	General	\N
1035	.AJ	tld-aj	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1041	.FD	tld-fd	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1045	.IH	tld-ih	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:57	\N	467000.00	0.00	General	\N
1127	.DS	tld-ds	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-14 13:34:51	\N	39000.00	0.00	General	\N
1080	.XI	tld-xi	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1081	.XK	tld-xk	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1082	.YB	tld-yb	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1083	.YD	tld-yd	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1084	.YH	tld-yh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1085	.YX	tld-yx	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1086	.ZC	tld-zc	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1087	.ZH	tld-zh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1088	.ZP	tld-zp	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1089	.ZS	tld-zs	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1090	.ZX	tld-zx	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1091	.ZY	tld-zy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1101	.QN	tld-qn	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	194000.00	0.00	General	\N
1096	.DIGITALASSET	tld-digitalasset	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	603000.00	0.00	General	\N
1094	.IOO	tld-ioo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	146000.00	0.00	General	\N
1107	.DE3	tld-de3	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	97000.00	0.00	General	\N
1095	.OD	tld-od	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	146000.00	0.00	General	\N
1103	.8888	tld-8888	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	3887000.00	0.00	General	\N
1105	.BTK9	tld-btk9	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	292000.00	0.00	General	\N
1123	.PDCST	tld-pdcst	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	194000.00	0.00	General	\N
1104	.4SALE	tld-4sale	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	389000.00	0.00	General	\N
1126	.MERC	tld-merc	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	894000.00	0.00	General	\N
1098	.ACA	tld-aca	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	214000.00	0.00	General	\N
1119	.XN--G6H	tld-xn--g6h	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	972000.00	0.00	General	\N
1071	.VQ	tld-vq	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1110	.W33D	tld-w33d	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	778000.00	0.00	General	\N
1133	.SHARK	tld-shark	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	233000.00	0.00	General	\N
1099	.SHORTCUT	tld-shortcut	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	58000.00	0.00	General	\N
1114	.XN--5O8H	tld-xn--5o8h	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	778000.00	0.00	General	\N
1102	.BLOGGING	tld-blogging	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-21 07:01:38	\N	78000.00	0.00	General	\N
1106	.C0M	tld-c0m	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	389000.00	0.00	General	\N
1113	.X2	tld-x2	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	778000.00	0.00	General	\N
1132	.X00M	tld-x00m	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-21 07:01:38	\N	78000.00	0.00	General	\N
1125	.JANUARY	tld-january	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	233000.00	0.00	General	\N
1124	.PRESENTER	tld-presenter	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	214000.00	0.00	General	\N
1112	.WEB4	tld-web4	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-21 07:01:38	\N	78000.00	0.00	General	\N
1120	.XN--PEI	tld-xn--pei	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	389000.00	0.00	General	\N
1108	.UK3	tld-uk3	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	97000.00	0.00	General	\N
1129	.MEV	tld-mev	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	292000.00	0.00	General	\N
1093	.NFTS	tld-nfts	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	146000.00	0.00	General	\N
1078	.XC	tld-xc	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1121	.XN--RCI	tld-xn--rci	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-22 07:01:27	\N	117000.00	0.00	General	\N
1069	.UF	tld-uf	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1073	.WJ	tld-wj	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1072	.WH	tld-wh	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1100	.DWEB3	tld-dweb3	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	58000.00	0.00	General	\N
1097	.FUNDRAISING	tld-fundraising	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	146000.00	0.00	General	\N
1130	.LAWSUIT	tld-lawsuit	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	583000.00	0.00	General	\N
1075	.WT	tld-wt	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1079	.XF	tld-xf	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1076	.XA	tld-xa	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1116	.XN--DEI	tld-xn--dei	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	233000.00	0.00	General	\N
1067	.RZ	tld-rz	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1092	.ILOVEU	tld-iloveu	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	262000.00	0.00	General	\N
1131	.SHP	tld-shp	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	194000.00	0.00	General	\N
1074	.WR	tld-wr	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1109	.US3	tld-us3	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	97000.00	0.00	General	\N
1066	.RN	tld-rn	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1070	.VJ	tld-vj	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1117	.XN--DP8H	tld-xn--dp8h	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	350000.00	0.00	General	\N
1068	.UE	tld-ue	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:58	\N	467000.00	0.00	General	\N
1115	.XN--6CA	tld-xn--6ca	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-04 07:02:34	\N	109000.00	0.00	General	\N
1128	.ABY	tld-aby	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	816000.00	0.00	General	\N
1122	.ZOY	tld-zoy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	136000.00	0.00	General	\N
1144	.HELL	tld-hell	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1145	.NEO	tld-neo	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1141	.INTEREST	tld-interest	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	292000.00	0.00	General	\N
1158	.LEGENDARY	tld-legendary	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	253000.00	0.00	General	\N
1140	.DECENTRALIZE	tld-decentralize	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	58000.00	0.00	General	\N
1147	.KEYS	tld-keys	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1143	.POCKETS	tld-pockets	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	136000.00	0.00	General	\N
1150	.VIE	tld-vie	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1136	.SAMPLES	tld-samples	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-08-22 07:01:27	\N	117000.00	0.00	General	\N
1148	.ITALY	tld-italy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1166	.BOG	tld-bog	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	253000.00	0.00	General	\N
1152	.MICRO	tld-micro	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	467000.00	0.00	General	\N
1151	.MOMMY	tld-mommy	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1154	.JPG	tld-jpg	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	467000.00	0.00	General	\N
1153	.NYM	tld-nym	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	467000.00	0.00	General	\N
1155	.TAR	tld-tar	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	467000.00	0.00	General	\N
1156	.TAO	tld-tao	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	467000.00	0.00	General	\N
1157	.POLICEMAN	tld-policeman	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	1458000.00	0.00	General	\N
1164	.SCHOOLING	tld-schooling	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	603000.00	0.00	General	\N
1160	.NOD	tld-nod	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	272000.00	0.00	General	\N
290	.INFO	tld-info	domain	700000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:45	\N	700000.00	525000.00	Popular	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
201	.EU	tld-eu	domain	214000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:36	\N	214000.00	0.00	Location	{"register":{"type":"fixed","value":175000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1159	.VASE	tld-vase	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	233000.00	0.00	General	\N
1162	.KIP	tld-kip	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	525000.00	0.00	General	\N
1168	.PAVE	tld-pave	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	292000.00	0.00	General	\N
1165	.REMEMBER	tld-remember	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:02:00	\N	292000.00	0.00	General	\N
1163	.GON	tld-gon	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	525000.00	0.00	General	\N
655	.DE	tld-de	domain	193000.00	mo	\N	f	2026-08-14 13:34:47	2026-09-06 07:01:45	\N	193000.00	0.00	General	{"register":{"type":"fixed","value":136000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
374	.ORG	tld-org	domain	369000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:31	\N	369000.00	239000.00	Popular	{"register":{"type":"fixed","value":282000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
349	.MOBI	tld-mobi	domain	1263000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:31	\N	1263000.00	1069000.00	International	{"register":{"type":"fixed","value":1069000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
532	.ORG.UK	tld-orguk	domain	194000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:31	\N	194000.00	0.00	General	{"register":{"type":"fixed","value":146000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
131	.CM	tld-cm	domain	3362000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:29	\N	3362000.00	0.00	International	{"register":{"type":"fixed","value":2740000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1138	.ADLT	tld-adlt	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	1302000.00	0.00	General	\N
1139	.HOMETOWN	tld-hometown	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	97000.00	0.00	General	\N
1135	.FREEBIES	tld-freebies	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	136000.00	0.00	General	\N
1134	.WEBARTIST	tld-webartist	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	1283000.00	0.00	General	\N
1142	.HITS	tld-hits	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	194000.00	0.00	General	\N
533	.WS	tld-ws	domain	758000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:45	\N	758000.00	0.00	General	{"register":{"type":"fixed","value":603000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
493	.US	tld-us	domain	214000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:45	\N	214000.00	156000.00	Location	{"register":{"type":"fixed","value":165000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1137	.GIVEAWAYS	tld-giveaways	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:08	\N	136000.00	0.00	General	\N
1161	.WE3	tld-we3	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	97000.00	0.00	General	\N
528	.ME.UK	tld-meuk	domain	194000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:30	\N	194000.00	0.00	General	{"register":{"type":"fixed","value":146000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1146	.CUBA	tld-cuba	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
1149	.XCAM	tld-xcam	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-06 07:01:59	\N	467000.00	0.00	General	\N
139	.COM	tld-com	domain	360000.00	yr	Best Seller	f	2025-12-24 19:07:21	2026-09-06 07:01:45	\N	360000.00	224000.00	Popular	{"register":{"type":"fixed","value":292000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
1167	.RUST	tld-rust	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:02:09	\N	136000.00	0.00	General	\N
475	.TIPS	tld-tips	domain	826000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:39	\N	826000.00	651000.00	International	{"register":{"type":"fixed","value":651000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
661	.NOM.ES	tld-nomes	domain	408000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-07 07:01:32	\N	408000.00	0.00	General	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
103	.CAMERA	tld-camera	domain	1419000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:46	\N	1419000.00	1205000.00	International	{"register":{"type":"fixed","value":1205000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
320	.LIGHTING	tld-lighting	domain	622000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:38	\N	622000.00	447000.00	International	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
184	.DIRECTORY	tld-directory	domain	719000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:46	\N	719000.00	564000.00	International	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
306	.KITCHEN	tld-kitchen	domain	1633000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	1633000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
477	.TODAY	tld-today	domain	758000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:39	\N	758000.00	583000.00	International	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
656	.COM.PE	tld-compe	domain	1943000.00	mo	\N	f	2026-08-14 13:34:47	2026-09-07 07:01:31	\N	1943000.00	2254000.00	General	{"register":{"type":"fixed","value":1730000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
659	.ES	tld-es	domain	564000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-07 07:01:32	\N	564000.00	0.00	General	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
145	.COM.SG	tld-comsg	domain	1244000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:45	\N	1244000.00	0.00	International	{"register":{"type":"fixed","value":1108000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
436	.SG	tld-sg	domain	1244000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:45	\N	1244000.00	0.00	Location	{"register":{"type":"fixed","value":1108000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
658	.ORG.PE	tld-orgpe	domain	1943000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-07 07:01:31	\N	1943000.00	2254000.00	General	{"register":{"type":"fixed","value":1730000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
140	.COM.AU	tld-comau	domain	408000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:32	\N	408000.00	0.00	International	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
663	.NET.AU	tld-netau	domain	408000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-07 07:01:32	\N	408000.00	0.00	General	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
296	.IO	tld-io	domain	1477000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:32	\N	1477000.00	1283000.00	Popular	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
664	.ORG.AU	tld-orgau	domain	408000.00	mo	\N	f	2026-08-14 13:34:48	2026-09-07 07:01:32	\N	408000.00	0.00	General	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
154	.CONTRACTORS	tld-contractors	domain	777000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:32	\N	777000.00	719000.00	International	{"register":{"type":"fixed","value":719000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
118	.CH	tld-ch	domain	525000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:32	\N	525000.00	0.00	International	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
73	.BIKE	tld-bike	domain	952000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:32	\N	952000.00	777000.00	International	{"register":{"type":"fixed","value":777000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
385	.PHOTOGRAPHY	tld-photography	domain	904000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:32	\N	904000.00	748000.00	Media	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
497	.VENTURES	tld-ventures	domain	1477000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:32	\N	1477000.00	1224000.00	Business	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
535	.US.COM	tld-uscom	domain	554000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:45	\N	554000.00	428000.00	General	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
198	.ENTERPRISES	tld-enterprises	domain	933000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	933000.00	680000.00	Business	{"register":{"type":"fixed","value":680000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
570	.JP.NET	tld-jpnet	domain	233000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-05 07:01:38	\N	233000.00	175000.00	General	{"register":{"type":"fixed","value":175000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
200	.ESTATE	tld-estate	domain	1030000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:32	\N	1030000.00	797000.00	Real Estate	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
414	.REPAIR	tld-repair	domain	923000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	923000.00	748000.00	International	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
294	.INTERNATIONAL	tld-international	domain	787000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	787000.00	632000.00	International	{"register":{"type":"fixed","value":632000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
410	.RED	tld-red	domain	554000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:40	\N	554000.00	476000.00	International	{"register":{"type":"fixed","value":476000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
386	.PHOTOS	tld-photos	domain	797000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	797000.00	622000.00	Media	{"register":{"type":"fixed","value":622000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
115	.CENTER	tld-center	domain	836000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	836000.00	680000.00	International	{"register":{"type":"fixed","value":680000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
372	.ONL	tld-onl	domain	564000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	564000.00	0.00	International	{"register":{"type":"fixed","value":467000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
104	.CAMP	tld-camp	domain	1535000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	1535000.00	1283000.00	International	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
212	.FARM	tld-farm	domain	972000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	972000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
409	.RECIPES	tld-recipes	domain	1866000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1866000.00	1594000.00	International	{"register":{"type":"fixed","value":1594000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
147	.COMPANY	tld-company	domain	544000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:46	\N	544000.00	428000.00	Business	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
188	.DOMAINS	tld-domains	domain	1050000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:46	\N	1050000.00	875000.00	International	{"register":{"type":"fixed","value":875000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
22	.ACADEMY	tld-academy	domain	1166000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	1166000.00	952000.00	Education	{"register":{"type":"fixed","value":952000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
194	.EMAIL	tld-email	domain	797000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	797000.00	641000.00	Tech	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
81	.BLUE	tld-blue	domain	641000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	641000.00	505000.00	International	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
492	.UNO	tld-uno	domain	622000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:39	\N	622000.00	0.00	International	{"register":{"type":"fixed","value":544000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
193	.EDUCATION	tld-education	domain	913000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	913000.00	719000.00	Education	{"register":{"type":"fixed","value":719000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
340	.MARKETING	tld-marketing	domain	1050000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1050000.00	855000.00	International	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
461	.SUPPORT	tld-support	domain	739000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	739000.00	564000.00	International	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
223	.FLORIST	tld-florist	domain	816000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	816000.00	622000.00	International	{"register":{"type":"fixed","value":622000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
274	.HOUSE	tld-house	domain	1088000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1088000.00	913000.00	Real Estate	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
260	.GUITARS	tld-guitars	domain	3109000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	3109000.00	2507000.00	International	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
292	.INSTITUTE	tld-institute	domain	739000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	739000.00	564000.00	Education	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
136	.COFFEE	tld-coffee	domain	933000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:46	\N	933000.00	875000.00	International	{"register":{"type":"fixed","value":875000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
449	.SOLAR	tld-solar	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	1594000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
539	.SHIKSHA	tld-shiksha	domain	1360000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:33	\N	1360000.00	1069000.00	General	{"register":{"type":"fixed","value":1069000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
420	.REVIEWS	tld-reviews	domain	1516000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	1516000.00	1283000.00	International	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
114	.CATERING	tld-catering	domain	952000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	952000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
398	.PRODUCTIONS	tld-productions	domain	991000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	991000.00	836000.00	Media	{"register":{"type":"fixed","value":836000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
509	.WATCH	tld-watch	domain	1108000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	1108000.00	855000.00	International	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
107	.CARDS	tld-cards	domain	952000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	952000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
146	.COMMUNITY	tld-community	domain	1147000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	1147000.00	933000.00	International	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
87	.BOUTIQUE	tld-boutique	domain	816000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	816000.00	622000.00	International	{"register":{"type":"fixed","value":622000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
543	.XN--6FRZ82G	tld-xn--6frz82g	domain	389000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:47	\N	389000.00	0.00	General	{"register":{"type":"fixed","value":292000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
66	.BARGAINS	tld-bargains	domain	739000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	739000.00	583000.00	International	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
289	.INDUSTRIES	tld-industries	domain	1147000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	1147000.00	933000.00	International	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
513	.WIKI	tld-wiki	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	855000.00	661000.00	Education	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
500	.VILLAS	tld-villas	domain	1458000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	1458000.00	1224000.00	Real Estate	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
94	.BUILD	tld-build	domain	777000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	777000.00	0.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
205	.EXPOSED	tld-exposed	domain	564000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	564000.00	447000.00	International	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
523	.ZONE	tld-zone	domain	1011000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	1011000.00	797000.00	Lifestyle	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
307	.KIWI	tld-kiwi	domain	694000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	694000.00	0.00	International	{"register":{"type":"fixed","value":622000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
150	.CONDOS	tld-condos	domain	1419000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	1419000.00	1205000.00	Real Estate	{"register":{"type":"fixed","value":1205000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
169	.DANCE	tld-dance	domain	719000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	719000.00	564000.00	International	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
365	.NINJA	tld-ninja	domain	836000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	836000.00	641000.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
400	.PROPERTIES	tld-properties	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	855000.00	797000.00	Real Estate	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
130	.CLUB	tld-club	domain	486000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:41	\N	486000.00	408000.00	Lifestyle	{"register":{"type":"fixed","value":408000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
233	.FUTBOL	tld-futbol	domain	428000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:34	\N	428000.00	330000.00	International	{"register":{"type":"fixed","value":330000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
540	.TIENDA	tld-tienda	domain	1458000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:34	\N	1458000.00	1224000.00	General	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
447	.SOCIAL	tld-social	domain	1088000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	1088000.00	855000.00	Lifestyle	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
222	.FLIGHTS	tld-flights	domain	1477000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	1477000.00	1205000.00	Location	{"register":{"type":"fixed","value":1205000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
301	.JETZT	tld-jetzt	domain	593000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:48	\N	593000.00	476000.00	International	{"register":{"type":"fixed","value":476000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
388	.PICTURES	tld-pictures	domain	408000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:43	\N	408000.00	321000.00	International	{"register":{"type":"fixed","value":321000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
316	.LEASE	tld-lease	domain	1438000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:36	\N	1438000.00	1147000.00	International	{"register":{"type":"fixed","value":1147000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
291	.INK	tld-ink	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	855000.00	661000.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
69	.BERLIN	tld-berlin	domain	1749000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:37	\N	1749000.00	0.00	Location	{"register":{"type":"fixed","value":1555000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
506	.VOTING	tld-voting	domain	28140000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:37	\N	28140000.00	0.00	International	{"register":{"type":"fixed","value":27168000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
321	.LIMITED	tld-limited	domain	777000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:37	\N	777000.00	739000.00	International	{"register":{"type":"fixed","value":739000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
415	.REPORT	tld-report	domain	671000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	671000.00	515000.00	International	{"register":{"type":"fixed","value":515000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
504	.VODKA	tld-vodka	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:35	\N	855000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
203	.EXCHANGE	tld-exchange	domain	972000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	972000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
218	.FISH	tld-fish	domain	1166000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:35	\N	1166000.00	913000.00	International	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
551	.NAGOYA	tld-nagoya	domain	486000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-07 07:01:34	\N	486000.00	0.00	General	{"register":{"type":"fixed","value":330000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
219	.FISHING	tld-fishing	domain	894000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:47	\N	894000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
482	.TOWN	tld-town	domain	923000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:36	\N	923000.00	748000.00	Location	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
417	.REST	tld-rest	domain	816000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:35	\N	816000.00	641000.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
403	.PUB	tld-pub	domain	1011000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	1011000.00	836000.00	International	{"register":{"type":"fixed","value":836000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
79	.BLACKFRIDAY	tld-blackfriday	domain	2624000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:35	\N	2624000.00	2507000.00	International	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
553	.CHRISTMAS	tld-christmas	domain	972000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-06 07:01:47	\N	972000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
52	.ASSOCIATES	tld-associates	domain	972000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:36	\N	972000.00	816000.00	International	{"register":{"type":"fixed","value":816000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
152	.CONSULTING	tld-consulting	domain	1322000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:36	\N	1322000.00	1127000.00	Business	{"register":{"type":"fixed","value":1127000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
257	.GRIPE	tld-gripe	domain	175000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:42	\N	175000.00	136000.00	International	{"register":{"type":"fixed","value":136000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
217	.FINANCIAL	tld-financial	domain	1302000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:37	\N	1302000.00	1205000.00	Finance	{"register":{"type":"fixed","value":1205000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
552	.REISEN	tld-reisen	domain	564000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-06 07:01:47	\N	564000.00	428000.00	General	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
491	.UNIVERSITY	tld-university	domain	1516000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:36	\N	1516000.00	1283000.00	Education	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
479	.TOOLS	tld-tools	domain	923000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:34	\N	923000.00	748000.00	International	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
331	.LONDON	tld-london	domain	816000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	816000.00	719000.00	Location	{"register":{"type":"fixed","value":719000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
57	.AUDIO	tld-audio	domain	3109000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	3109000.00	2507000.00	Media	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
544	.JUEGOS	tld-juegos	domain	9309000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-07 07:01:39	\N	9309000.00	7171000.00	General	{"register":{"type":"fixed","value":7171000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
496	.VEGAS	tld-vegas	domain	1263000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	1263000.00	1011000.00	International	{"register":{"type":"fixed","value":1011000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
112	.CASH	tld-cash	domain	991000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	991000.00	797000.00	Finance	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
182	.DIGITAL	tld-digital	domain	1050000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	1050000.00	855000.00	Tech	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
546	.SURF	tld-surf	domain	855000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-07 07:01:39	\N	855000.00	0.00	General	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
259	.GUIDE	tld-guide	domain	1059000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	1059000.00	845000.00	International	{"register":{"type":"fixed","value":845000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
465	.TAX	tld-tax	domain	1671000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	1671000.00	1399000.00	Finance	{"register":{"type":"fixed","value":1399000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
328	.LOANS	tld-loans	domain	2818000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	2818000.00	2390000.00	International	{"register":{"type":"fixed","value":2390000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
24	.ACCOUNTANTS	tld-accountants	domain	2837000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	2837000.00	2390000.00	International	{"register":{"type":"fixed","value":2390000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
216	.FINANCE	tld-finance	domain	1613000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:38	\N	1613000.00	1341000.00	Finance	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
548	.ATTORNEY	tld-attorney	domain	1496000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-07 07:01:39	\N	1496000.00	1283000.00	General	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
293	.INSURE	tld-insure	domain	1788000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	1788000.00	1496000.00	International	{"register":{"type":"fixed","value":1496000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
416	.REPUBLICAN	tld-republican	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:38	\N	855000.00	622000.00	International	{"register":{"type":"fixed","value":622000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
173	.DEALS	tld-deals	domain	1011000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:48	\N	1011000.00	797000.00	Commerce	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
264	.HEALTHCARE	tld-healthcare	domain	2177000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	2177000.00	1827000.00	International	{"register":{"type":"fixed","value":1827000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
123	.CITY	tld-city	domain	739000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:48	\N	739000.00	583000.00	Location	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
185	.DISCOUNT	tld-discount	domain	777000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	777000.00	583000.00	Commerce	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
124	.CLAIMS	tld-claims	domain	1613000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	1613000.00	1341000.00	International	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
232	.FURNITURE	tld-furniture	domain	2488000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	2488000.00	1963000.00	International	{"register":{"type":"fixed","value":1963000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
163	.CREDITCARD	tld-creditcard	domain	3284000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	3284000.00	3051000.00	International	{"register":{"type":"fixed","value":3051000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
255	.GRATIS	tld-gratis	domain	622000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:43	\N	622000.00	486000.00	International	{"register":{"type":"fixed","value":486000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
430	.SCHULE	tld-schule	domain	641000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	641000.00	583000.00	International	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
247	.GLOBAL	tld-global	domain	2488000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	2488000.00	2002000.00	International	{"register":{"type":"fixed","value":2002000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
196	.ENGINEER	tld-engineer	domain	1030000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	1030000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
273	.HOSTING	tld-hosting	domain	8512000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	8512000.00	8512000.00	Tech	{"register":{"type":"fixed","value":7890000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
285	.IMMO	tld-immo	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	855000.00	719000.00	International	{"register":{"type":"fixed","value":719000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
518	.WORLD	tld-world	domain	1030000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	1030000.00	855000.00	Lifestyle	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
126	.CLICK	tld-click	domain	350000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:44	\N	350000.00	253000.00	Tech	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
174	.DEGREE	tld-degree	domain	1302000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	1302000.00	1069000.00	International	{"register":{"type":"fixed","value":1069000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
422	.RIP	tld-rip	domain	641000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	641000.00	486000.00	International	{"register":{"type":"fixed","value":486000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
63	.BAND	tld-band	domain	777000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	777000.00	641000.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
498	.VET	tld-vet	domain	1030000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:39	\N	1030000.00	855000.00	International	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
164	.CRICKET	tld-cricket	domain	622000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	622000.00	505000.00	International	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
512	.WEDDING	tld-wedding	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	855000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
355	.MORTGAGE	tld-mortgage	domain	1496000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	1496000.00	1283000.00	Real Estate	{"register":{"type":"fixed","value":1283000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
550	.NAVY	tld-navy	domain	894000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-07 07:01:39	\N	894000.00	855000.00	General	{"register":{"type":"fixed","value":855000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
134	.COACH	tld-coach	domain	1866000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	1866000.00	1594000.00	International	{"register":{"type":"fixed","value":1594000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
418	.RESTAURANT	tld-restaurant	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:49	\N	1594000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
390	.PIZZA	tld-pizza	domain	1633000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:49	\N	1633000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
96	.BUSINESS	tld-business	domain	505000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	505000.00	389000.00	Business	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
554	.DIET	tld-diet	domain	3109000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-07 07:01:40	\N	3109000.00	2507000.00	General	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
245	.GIVES	tld-gives	domain	739000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:49	\N	739000.00	544000.00	International	{"register":{"type":"fixed","value":544000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
195	.ENERGY	tld-energy	domain	3032000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:40	\N	3032000.00	2390000.00	International	{"register":{"type":"fixed","value":2390000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
555	.CYMRU	tld-cymru	domain	369000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:40	\N	369000.00	0.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
452	.SPACE	tld-space	domain	632000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:49	\N	632000.00	560000.00	International	{"register":{"type":"fixed","value":35000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
23	.ACCOUNTANT	tld-accountant	domain	622000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	622000.00	505000.00	Finance	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
429	.SCHOOL	tld-school	domain	972000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	972000.00	748000.00	Education	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
187	.DOG	tld-dog	domain	1691000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:42	\N	1691000.00	1341000.00	International	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
472	.THEATER	tld-theater	domain	1574000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	1574000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
373	.ONLINE	tld-online	domain	680000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	680000.00	632000.00	Tech	{"register":{"type":"fixed","value":56000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
446	.SOCCER	tld-soccer	domain	573000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	573000.00	535000.00	International	{"register":{"type":"fixed","value":535000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
213	.FASHION	tld-fashion	domain	894000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:49	\N	894000.00	0.00	Commerce	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
334	.LTDA	tld-ltda	domain	913000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	913000.00	0.00	International	{"register":{"type":"fixed","value":836000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
28	.ADULT	tld-adult	domain	3245000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	3245000.00	2507000.00	International	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
74	.BINGO	tld-bingo	domain	1341000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	1341000.00	1011000.00	International	{"register":{"type":"fixed","value":1011000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
471	.TENNIS	tld-tennis	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	1594000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
499	.VIDEO	tld-video	domain	962000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	962000.00	748000.00	Media	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
220	.FIT	tld-fit	domain	894000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:49	\N	894000.00	0.00	Lifestyle	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
226	.FOOTBALL	tld-football	domain	719000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:47	\N	719000.00	525000.00	International	{"register":{"type":"fixed","value":525000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
250	.GOLF	tld-golf	domain	1633000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	1633000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
113	.CASINO	tld-casino	domain	3731000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	3731000.00	3343000.00	International	{"register":{"type":"fixed","value":3343000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
302	.JEWELRY	tld-jewelry	domain	1360000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	1360000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
458	.SUCKS	tld-sucks	domain	5792000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	5792000.00	0.00	International	{"register":{"type":"fixed","value":5422000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
356	.MOVIE	tld-movie	domain	8687000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	8687000.00	7190000.00	Media	{"register":{"type":"fixed","value":7190000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
393	.PLUS	tld-plus	domain	1419000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	1419000.00	1127000.00	International	{"register":{"type":"fixed","value":1127000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
443	.SITE	tld-site	domain	622000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	622000.00	632000.00	Tech	{"register":{"type":"fixed","value":35000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
102	.CAFE	tld-cafe	domain	1263000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:41	\N	1263000.00	1069000.00	International	{"register":{"type":"fixed","value":1069000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
467	.TEAM	tld-team	domain	904000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	904000.00	748000.00	International	{"register":{"type":"fixed","value":748000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
266	.HOCKEY	tld-hockey	domain	1419000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	1419000.00	1224000.00	International	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
318	.LGBT	tld-lgbt	domain	1827000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	1827000.00	1652000.00	International	{"register":{"type":"fixed","value":1652000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
480	.TOP	tld-top	domain	136000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:49	\N	136000.00	117000.00	International	{"register":{"type":"fixed","value":117000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
397	.PRO	tld-pro	domain	661000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	661000.00	564000.00	Business	{"register":{"type":"fixed","value":564000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
190	.EARTH	tld-earth	domain	544000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:48	\N	544000.00	0.00	International	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
352	.MOM	tld-mom	domain	894000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	894000.00	0.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
455	.STUDIO	tld-studio	domain	1030000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	1030000.00	777000.00	Media	{"register":{"type":"fixed","value":777000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
160	.COURSES	tld-courses	domain	991000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:42	\N	991000.00	797000.00	Education	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
560	.UK.COM	tld-ukcom	domain	748000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:42	\N	748000.00	671000.00	General	{"register":{"type":"fixed","value":671000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
562	.JPN.COM	tld-jpncom	domain	952000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:42	\N	952000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
137	.COLLEGE	tld-college	domain	1594000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:42	\N	1594000.00	1224000.00	Education	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
58	.AUTO	tld-auto	domain	57329000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:43	\N	57329000.00	45241000.00	International	{"register":{"type":"fixed","value":44659000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
444	.SKI	tld-ski	domain	1613000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	1613000.00	0.00	International	{"register":{"type":"fixed","value":1496000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
566	.UK.NET	tld-uknet	domain	748000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	748000.00	671000.00	General	{"register":{"type":"fixed","value":671000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
324	.LIVE	tld-live	domain	768000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:50	\N	768000.00	671000.00	Lifestyle	{"register":{"type":"fixed","value":671000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
564	.RU.COM	tld-rucom	domain	4295000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:42	\N	4295000.00	3440000.00	General	{"register":{"type":"fixed","value":3440000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
561	.CN.COM	tld-cncom	domain	1011000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-06 07:01:50	\N	1011000.00	758000.00	General	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
262	.HAMBURG	tld-hamburg	domain	1438000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	1438000.00	0.00	International	{"register":{"type":"fixed","value":1360000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
412	.RENT	tld-rent	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:42	\N	1594000.00	1224000.00	Real Estate	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
571	.COM.SE	tld-comse	domain	292000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	292000.00	194000.00	General	{"register":{"type":"fixed","value":194000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
214	.FEEDBACK	tld-feedback	domain	9523000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:43	\N	9523000.00	7579000.00	International	{"register":{"type":"fixed","value":7579000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
110	.CARS	tld-cars	domain	57329000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:43	\N	57329000.00	45241000.00	International	{"register":{"type":"fixed","value":44659000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
89	.BR.COM	tld-brcom	domain	1166000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:42	\N	1166000.00	913000.00	International	{"register":{"type":"fixed","value":913000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
567	.SE.NET	tld-senet	domain	875000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	875000.00	641000.00	General	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
573	.IN.NET	tld-innet	domain	204000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-06 07:01:50	\N	204000.00	156000.00	General	{"register":{"type":"fixed","value":156000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
211	.FANS	tld-fans	domain	272000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:48	\N	272000.00	214000.00	Lifestyle	{"register":{"type":"fixed","value":214000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
558	.RYUKYU	tld-ryukyu	domain	447000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-05 07:01:48	\N	447000.00	0.00	General	{"register":{"type":"fixed","value":350000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
47	.ART	tld-art	domain	641000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	641000.00	505000.00	Media	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
44	.APP	tld-app	domain	447000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:50	\N	447000.00	350000.00	Tech	{"register":{"type":"fixed","value":350000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
32	.AFRICA	tld-africa	domain	309000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:50	\N	309000.00	253000.00	International	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
242	.GG	tld-gg	domain	1613000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	1613000.00	1341000.00	International	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
577	.COM.VC	tld-comvc	domain	816000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	816000.00	641000.00	General	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
237	.GAMES	tld-games	domain	836000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	836000.00	700000.00	Lifestyle	{"register":{"type":"fixed","value":700000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
236	.GAME	tld-game	domain	10650000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	10650000.00	8337000.00	Lifestyle	{"register":{"type":"fixed","value":8337000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
586	.REALTY	tld-realty	domain	8881000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:44	\N	8881000.00	0.00	General	{"register":{"type":"fixed","value":6083000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
453	.STORE	tld-store	domain	855000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	855000.00	972000.00	Commerce	{"register":{"type":"fixed","value":56000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
580	.KRD	tld-krd	domain	875000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	875000.00	583000.00	General	{"register":{"type":"fixed","value":680000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
333	.LTD	tld-ltd	domain	836000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	836000.00	641000.00	Business	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
578	.NET.VC	tld-netvc	domain	855000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:43	\N	855000.00	641000.00	General	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
297	.IRISH	tld-irish	domain	622000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:49	\N	622000.00	447000.00	International	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
583	.OSAKA	tld-osaka	domain	816000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:44	\N	816000.00	0.00	General	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
191	.ECO	tld-eco	domain	1982000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	1982000.00	1419000.00	International	{"register":{"type":"fixed","value":1419000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
589	.HEALTH	tld-health	domain	2099000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:44	\N	2099000.00	1613000.00	General	{"register":{"type":"fixed","value":1613000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
582	.MELBOURNE	tld-melbourne	domain	1050000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-06 07:01:51	\N	1050000.00	875000.00	General	{"register":{"type":"fixed","value":875000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
440	.SHOPPING	tld-shopping	domain	739000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:51	\N	739000.00	583000.00	Commerce	{"register":{"type":"fixed","value":583000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
584	.YOKOHAMA	tld-yokohama	domain	447000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:44	\N	447000.00	0.00	General	{"register":{"type":"fixed","value":330000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
21	.AC	tld-ac	domain	1496000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	1496000.00	1224000.00	Education	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
80	.BLOG	tld-blog	domain	641000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	641000.00	467000.00	Media	{"register":{"type":"fixed","value":467000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
359	.NAME	tld-name	domain	194000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	194000.00	175000.00	International	{"register":{"type":"fixed","value":175000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
437	.SH	tld-sh	domain	1496000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	1496000.00	1224000.00	International	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
310	.KYOTO	tld-kyoto	domain	1535000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	1535000.00	0.00	International	{"register":{"type":"fixed","value":1380000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
501	.VIN	tld-vin	domain	1477000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	1477000.00	1224000.00	International	{"register":{"type":"fixed","value":1224000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
621	.MOV	tld-mov	domain	311000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:52	\N	311000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
383	.PH	tld-ph	domain	1108000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	1108000.00	1341000.00	International	{"register":{"type":"fixed","value":1030000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
617	.BOO	tld-boo	domain	330000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	330000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
298	.IS	tld-is	domain	1555000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	1555000.00	0.00	International	{"register":{"type":"fixed","value":1302000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
625	.PHD	tld-phd	domain	583000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	583000.00	505000.00	General	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
288	.INC	tld-inc	domain	54375000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	54375000.00	40772000.00	Business	{"register":{"type":"fixed","value":40772000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
619	.GIVING	tld-giving	domain	700000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:52	\N	700000.00	544000.00	General	{"register":{"type":"fixed","value":544000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
590	.ICU	tld-icu	domain	525000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:50	\N	525000.00	389000.00	General	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
376	.PAGE	tld-page	domain	330000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	330000.00	253000.00	International	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
623	.NEXUS	tld-nexus	domain	311000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:52	\N	311000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
487	.TRAVEL	tld-travel	domain	3634000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:44	\N	3634000.00	3071000.00	Location	{"register":{"type":"fixed","value":3071000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
594	.ORG.PH	tld-orgph	domain	1147000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	1147000.00	1341000.00	General	{"register":{"type":"fixed","value":1030000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
595	.NET.PH	tld-netph	domain	1147000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	1147000.00	1341000.00	General	{"register":{"type":"fixed","value":1030000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
464	.TATTOO	tld-tattoo	domain	952000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	952000.00	758000.00	International	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
593	.COM.PH	tld-comph	domain	1147000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	1147000.00	1341000.00	General	{"register":{"type":"fixed","value":1030000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
314	.LAW	tld-law	domain	2546000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	2546000.00	2060000.00	International	{"register":{"type":"fixed","value":2060000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
599	.CYOU	tld-cyou	domain	505000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	505000.00	389000.00	General	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
153	.CONTACT	tld-contact	domain	327000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:51	\N	327000.00	272000.00	International	{"register":{"type":"fixed","value":272000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
603	.SBS	tld-sbs	domain	505000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	505000.00	389000.00	General	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
239	.GAY	tld-gay	domain	991000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	991000.00	797000.00	International	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
85	.BOSTON	tld-boston	domain	603000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:51	\N	603000.00	486000.00	International	{"register":{"type":"fixed","value":486000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
117	.CFD	tld-cfd	domain	525000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:51	\N	525000.00	389000.00	International	{"register":{"type":"fixed","value":389000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
474	.TICKETS	tld-tickets	domain	11835000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	11835000.00	8939000.00	International	{"register":{"type":"fixed","value":8939000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
620	.FOO	tld-foo	domain	350000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:52	\N	350000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
172	.DAY	tld-day	domain	330000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:45	\N	330000.00	253000.00	International	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
364	.NGO	tld-ngo	domain	486000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	486000.00	369000.00	International	{"register":{"type":"fixed","value":369000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
534	.XXX	tld-xxx	domain	3012000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:31	\N	3012000.00	2507000.00	General	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
638	.CO.IM	tld-coim	domain	243000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	243000.00	0.00	General	{"register":{"type":"fixed","value":165000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
633	.FOOD	tld-food	domain	952000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	952000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
537	.US.ORG	tld-usorg	domain	515000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-06 07:01:45	\N	515000.00	428000.00	General	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
639	.COM.IM	tld-comim	domain	243000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	243000.00	0.00	General	{"register":{"type":"fixed","value":165000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
360	.NET	tld-net	domain	362000.00	yr	Best Seller	f	2025-12-24 19:07:22	2026-09-06 07:01:45	\N	362000.00	253000.00	Popular	{"register":{"type":"fixed","value":292000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
271	.HOSPITAL	tld-hospital	domain	1399000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	1399000.00	1088000.00	International	{"register":{"type":"fixed","value":1088000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
635	.LIVING	tld-living	domain	952000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	952000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
71	.BET	tld-bet	domain	700000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:52	\N	700000.00	525000.00	International	{"register":{"type":"fixed","value":525000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
641	.ORG.IM	tld-orgim	domain	243000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	243000.00	0.00	General	{"register":{"type":"fixed","value":165000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
382	.PET	tld-pet	domain	700000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:52	\N	700000.00	544000.00	International	{"register":{"type":"fixed","value":544000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
644	.FREE	tld-free	domain	875000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-06 07:01:52	\N	875000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
629	.FOREX	tld-forex	domain	2604000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	2604000.00	2138000.00	General	{"register":{"type":"fixed","value":2138000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
427	.SALON	tld-salon	domain	1360000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:45	\N	1360000.00	1088000.00	Lifestyle	{"register":{"type":"fixed","value":1088000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
86	.BOT	tld-bot	domain	1535000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:45	\N	1535000.00	1263000.00	International	{"register":{"type":"fixed","value":1263000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
210	.FAN	tld-fan	domain	1341000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:45	\N	1341000.00	1127000.00	Lifestyle	{"register":{"type":"fixed","value":1127000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
630	.MARKETS	tld-markets	domain	525000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:52	\N	525000.00	408000.00	General	{"register":{"type":"fixed","value":408000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
631	.ING	tld-ing	domain	330000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	330000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
367	.NOW	tld-now	domain	972000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:52	\N	972000.00	758000.00	International	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
637	.DEAL	tld-deal	domain	952000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	952000.00	758000.00	General	{"register":{"type":"fixed","value":758000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
357	.MUSIC	tld-music	domain	1020000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:46	\N	1020000.00	933000.00	Media	{"register":{"type":"fixed","value":933000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
527	.CO.UK	tld-couk	domain	194000.00	mo	\N	f	2026-08-14 12:50:36	2026-09-07 07:01:30	\N	194000.00	0.00	General	{"register":{"type":"fixed","value":146000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
653	.MOBILE	tld-mobile	domain	525000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	525000.00	447000.00	General	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
645	.HOT	tld-hot	domain	1147000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:46	\N	1147000.00	1030000.00	General	{"register":{"type":"fixed","value":1030000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
358	.MY	tld-my	domain	758000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:46	\N	758000.00	641000.00	International	{"register":{"type":"fixed","value":641000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
26	.AD	tld-ad	domain	700000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:52	\N	700000.00	428000.00	International	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
626	.ESQ	tld-esq	domain	583000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	583000.00	505000.00	General	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
721	.ISTHEFUTURE	tld-isthefuture	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:55	\N	389000.00	0.00	General	\N
261	.GURU	tld-guru	domain	1069000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	1069000.00	875000.00	International	{"register":{"type":"fixed","value":875000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
876	.EATHERE	tld-eathere	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:49	\N	1477000.00	0.00	General	\N
844	.COMMUNION	tld-communion	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	1030000.00	0.00	General	\N
267	.HOLDINGS	tld-holdings	domain	1594000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	1594000.00	1322000.00	International	{"register":{"type":"fixed","value":1322000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
442	.SINGLES	tld-singles	domain	719000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:46	\N	719000.00	661000.00	Lifestyle	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
338	.MANAGEMENT	tld-management	domain	680000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	680000.00	525000.00	Business	{"register":{"type":"fixed","value":525000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
46	.ARMY	tld-army	domain	952000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:39	\N	952000.00	816000.00	International	{"register":{"type":"fixed","value":816000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
627	.PROF	tld-prof	domain	571000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-07 07:01:45	\N	571000.00	505000.00	General	{"register":{"type":"fixed","value":505000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
791	.YOLO	tld-yolo	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	778000.00	0.00	General	\N
760	.SECRETS	tld-secrets	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:54	\N	1167000.00	0.00	General	\N
229	.FR	tld-fr	domain	408000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:38	\N	408000.00	0.00	International	{"register":{"type":"fixed","value":350000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
165	.CRUISES	tld-cruises	domain	1341000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	1341000.00	1069000.00	International	{"register":{"type":"fixed","value":1069000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
33	.AGENCY	tld-agency	domain	816000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	816000.00	632000.00	Business	{"register":{"type":"fixed","value":632000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
109	.CAREERS	tld-careers	domain	1749000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	1749000.00	1477000.00	International	{"register":{"type":"fixed","value":1477000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
234	.FYI	tld-fyi	domain	189000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-05 07:01:48	\N	189000.00	136000.00	International	{"register":{"type":"fixed","value":136000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
556	.WALES	tld-wales	domain	369000.00	mo	\N	f	2026-08-14 12:52:39	2026-09-07 07:01:40	\N	369000.00	0.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
549	.OKINAWA	tld-okinawa	domain	447000.00	mo	\N	f	2026-08-14 12:50:37	2026-09-05 07:01:44	\N	447000.00	0.00	General	{"register":{"type":"fixed","value":350000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
434	.SEX	tld-sex	domain	3012000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	3012000.00	2507000.00	International	{"register":{"type":"fixed","value":2507000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
733	.MAGAZINE	tld-magazine	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:48	\N	2294000.00	0.00	General	\N
795	.ZUG	tld-zug	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-06 07:01:55	\N	564000.00	0.00	General	\N
818	.BADLY	tld-badly	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:58	\N	311000.00	0.00	General	\N
891	.FIJI	tld-fiji	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-05 07:01:59	\N	894000.00	0.00	General	\N
860	.D8	tld-d8	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-05 07:01:59	\N	894000.00	0.00	General	\N
459	.SUPPLIES	tld-supplies	domain	632000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:47	\N	632000.00	496000.00	International	{"register":{"type":"fixed","value":496000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
225	.FM	tld-fm	domain	2313000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	2313000.00	1943000.00	International	{"register":{"type":"fixed","value":1943000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
158	.COUNTRY	tld-country	domain	47612000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:35	\N	47612000.00	0.00	International	{"register":{"type":"fixed","value":44659000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
127	.CLINIC	tld-clinic	domain	1613000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:37	\N	1613000.00	1341000.00	International	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
426	.SALE	tld-sale	domain	952000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:41	\N	952000.00	797000.00	Commerce	{"register":{"type":"fixed","value":797000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
507	.VOTO	tld-voto	domain	1691000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:43	\N	1691000.00	1341000.00	International	{"register":{"type":"fixed","value":1341000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
435	.SEXY	tld-sexy	domain	64092000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:33	\N	64092000.00	56319000.00	International	{"register":{"type":"fixed","value":58262000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
149	.COMPUTER	tld-computer	domain	952000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:33	\N	952000.00	816000.00	International	{"register":{"type":"fixed","value":816000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
65	.BAR	tld-bar	domain	1594000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:35	\N	1594000.00	1263000.00	International	{"register":{"type":"fixed","value":1263000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
346	.MEMORIAL	tld-memorial	domain	1263000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:40	\N	1263000.00	1069000.00	International	{"register":{"type":"fixed","value":1069000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
61	.BABY	tld-baby	domain	1594000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-07 07:01:44	\N	1594000.00	1263000.00	International	{"register":{"type":"fixed","value":1263000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
774	.TRADER	tld-trader	domain	0.00	mo	\N	f	2026-08-14 13:34:50	2026-09-07 07:01:49	\N	1477000.00	0.00	General	\N
1025	.WHITEPAPER	tld-whitepaper	domain	0.00	mo	\N	f	2026-08-14 13:34:51	2026-09-07 07:01:51	\N	5811000.00	0.00	General	\N
317	.LEGAL	tld-legal	domain	1730000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:49	\N	1730000.00	1458000.00	International	{"register":{"type":"fixed","value":1458000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
643	.CHANNEL	tld-channel	domain	321000.00	mo	\N	f	2026-08-14 12:52:40	2026-09-05 07:01:53	\N	321000.00	253000.00	General	{"register":{"type":"fixed","value":253000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
522	.YOGA	tld-yoga	domain	894000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-06 07:01:49	\N	894000.00	0.00	International	{"register":{"type":"fixed","value":661000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
99	.BZ	tld-bz	domain	525000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:44	\N	525000.00	428000.00	International	{"register":{"type":"fixed","value":428000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
254	.GRAPHICS	tld-graphics	domain	622000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-05 07:01:38	\N	622000.00	447000.00	Media	{"register":{"type":"fixed","value":447000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
128	.CLOTHING	tld-clothing	domain	694000.00	yr	\N	f	2025-12-24 19:07:21	2026-09-06 07:01:46	\N	694000.00	622000.00	Commerce	{"register":{"type":"fixed","value":622000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
381	.PE	tld-pe	domain	1866000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:31	\N	1866000.00	2254000.00	International	{"register":{"type":"fixed","value":1730000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
392	.PLUMBING	tld-plumbing	domain	1749000.00	yr	\N	f	2025-12-24 19:07:22	2026-09-07 07:01:32	\N	1749000.00	1496000.00	International	{"register":{"type":"fixed","value":1496000,"label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
\.


--
-- Data for Name: saas_products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.saas_products (id, user_id, name, slug, category, tagline, description, price, thumbnail, status, created_at, updated_at, features, plans) FROM stdin;
4	1	Chatbot Plugin	chatbot-plugin	Plugin	Plugin Chatbot pintar untuk integrasi instan	FutureCloud AI Chatbot Plugin adalah solusi cerdas untuk mengotomatiskan layanan pelanggan di aplikasi Anda menggunakan teknologi AI terkini.	79000.00	storage/plugins/XWKNKD0yAj8n7Mue6JwNon83BABlDq7xTxc4e91P.webp	approved	2026-07-10 14:07:42	2026-08-14 19:58:49	["Kecerdasan Buatan (AI): Chatbot tidak kaku, memahami konteks percakapan secara natural dan interaktif","Kelola Pengetahuan AI (Knowledge Base): Latih AI dengan data dan pengetahuan spesifik mengenai bisnis Anda","Pantau Chat: Pantau seluruh riwayat interaksi bot dengan pengunjung secara real-time","Live Chat \\/ Human Takeover: Ambil alih percakapan dari bot jika pelanggan membutuhkan bantuan manusia"]	{"cycle":"monthly_yearly","annual_discount_type":"percent","annual_discount_value":"20"}
5	1	Monitoring Visitor Plugin	monitoring-visitor-plugin	Plugin	Plugin Monitoring Visitor secara real-time	Monitoring Visitor Plugin memberikan wawasan analitik yang mendalam mengenai lalu lintas pengunjung di website atau aplikasi Anda secara real-time, tanpa membebani performa server.	79000.00	storage/plugins/wA7a0ReUim1iWk8HhAolQRndTPUa9aG3vts4Llfi.webp	approved	2026-07-10 14:07:42	2026-08-14 19:58:49	["Real-Time Analytics: Pantau jumlah pengunjung yang sedang aktif di situs Anda secara langsung","Detail Pengunjung: Lacak info lokasi geografis, jenis perangkat, browser, dan sistem operasi","Page Tracking: Ketahui halaman mana yang sedang dilihat pengunjung dan alur navigasi mereka","Dashboard Interaktif: Visualisasi metrik dan grafik yang modern dan mudah dipahami"]	{"cycle":"monthly_yearly","annual_discount_type":"percent","annual_discount_value":"20"}
7	1	Langganan Paket Pro Smartrack.id	langganan-paket-pro-smartrackid	Marketing	Semua fitur smartrack dasar, plus kapasitas lebih besar.	Langganan paket pro smartrack.id akan membuka semua fitur dasar smartrack dan meningkatkan kapasitas penyimpanan yang lebih besar.	100000.00	storage/saas/7HkFcMMDG3glMPCt9P30MZrFe0UzOlmCiDkkVsDI.webp	approved	2026-08-14 01:53:06	2026-08-14 19:58:49	[]	{"plan_1786647038763":{"name":"Pro","price":"100000","features_raw":"Unlimited produk & kasir, 1.024MB storage, 3.000 transaksi\\/bulan, Multi toko \\u2014 kelola banyak cabang, Laporan lengkap + export PDF\\/Excel"},"cycle":"monthly_yearly","annual_discount_type":"fixed","annual_discount_value":"200000","is_external_url_active":"1","external_url":"https:\\/\\/smartrack.id\\/#harga"}
8	1	Langganan Paket Scanyuk.com	langganan-paket-scanyukcom	Productivity	Pilih paket yang sesuai kebutuhan Anda. Kuota tidak expired selama belum dipakai.	Paket experience scanyuk.com, wujudkan lebih banyak kreasi AR mu dengan Upgrade Paket	100000.00	storage/saas/ku4Mg3h8L5UwYS6EruKUmFv9fP3KvPioSzCN80KU.webp	approved	2026-08-14 02:10:49	2026-08-14 19:58:49	[]	{"plan_1786648002894":{"name":"Pemula","price":"100000","features_raw":"2 AR Image, 2 Voice Narration, Tak Terbatas Total Scans, Analitik lengkap, Unduh QR"},"plan_1786648172626":{"name":"Profesional","price":"500000","features_raw":"10 AR Image, 10 Voice Narration, Tak Terbatas Total Scans, Dukungan prioritas, QR siap cetak"},"plan_1786648207796":{"name":"Bisnis","price":"1000000","features_raw":"20 AR Image, 20 Voice Narration, Tak Terbatas Total Scans, Dukungan prioritas, QR siap cetak"},"cycle":"lifetime","annual_discount_type":"percent","annual_discount_value":"0","is_external_url_active":"1","external_url":"https:\\/\\/scanyuk.com\\/pricing"}
9	1	Langganan Paket Ngajak.my.id	langganan-paket-ngajakmyid	Productivity	Mulai dari undangan sederhana hingga paket enterprise untuk reseller & event organizer.	Paket ngajak.my.id, perluas jangkauan undangan mu dengan berlangganan paket ngajak.my.id, dan buka lebih banyak fitur.	29000.00	storage/saas/cgSdn38Sn2RXPXL8OSdKZvMpL6Hb9UEMOFycacWb.webp	approved	2026-08-14 02:17:01	2026-08-14 19:58:49	[]	{"plan_1786648276795":{"name":"Basic","price":"29000","features_raw":"Template Premium, Nama Tamu Otomatis, Countdown Acara, Google Maps, Galeri Foto, Love Story, Musik Background, Amplop Digital, Ucapan & Doa Tamu"},"plan_1786648505731":{"name":"Premium","price":"49000","features_raw":"Template Premium, Nama Tamu Otomatis, Countdown Acara, Google Maps, Galeri Foto, Love Story, Musik Background, Amplop Digital, Ucapan & Doa Tamu, RSVP, Statistik RSVP"},"plan_1786648544676":{"name":"Ultimate","price":"79000","features_raw":"Template Premium, Nama Tamu Otomatis, Countdown Acara, Google Maps, Galeri Foto, Love Story, Musik Background, Amplop Digital, Ucapan & Doa Tamu, RSVP, Statistik RSVP, Real-time Tracking Tamu, Daftar Tamu Sudah Membuka, Daftar Tamu Belum Membuka, Dashboard Monitoring"},"cycle":"monthly","annual_discount_type":"percent","annual_discount_value":"0","is_external_url_active":"1","external_url":"https:\\/\\/ngajak.my.id\\/pricing"}
10	1	Langganan Paket Leadly	langganan-paket-leadly	Productivity	Langganan Paket Leadly untuk membuka lebih banyak leads dan fitur premium lainnya	Anda dapat mulai gratis, dan upgrade jika leads-nya sudah mulai berjalan. Dengan langganan Paket Leadly untuk membuka lebih banyak leads dan fitur premium lainnya	149000.00	storage/saas/2dtkIgNvWx7MTp32KrtiUe1srZBgNglTuK8wCDlx.webp	approved	2026-08-14 02:22:02	2026-08-14 19:58:49	[]	{"plan_1786648679339":{"name":"Leadly Reguler","price":"149000","features_raw":"10.000 leads \\/ bulan, Keyword tak terbatas, Upload keyword massal (.txt), Filter nomor HP otomatis"},"cycle":"monthly","annual_discount_type":"percent","annual_discount_value":"0","is_external_url_active":"1","external_url":"https:\\/\\/lead.futurecloud.id\\/#harga"}
\.


--
-- Data for Name: saas_reviews; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.saas_reviews (id, user_id, saas_slug, rating, comment, created_at, updated_at) FROM stdin;
1	12	fast-vpn	5	Mantap	2026-06-03 06:52:56	2026-06-03 06:52:56
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
lvwV4dfvawt97otavtQc03zTLCU5atIPqKE09FPF	\N	66.249.79.36	Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko; compatible; Googlebot/2.1; +http://www.google.com/bot.html) Chrome/151.0.7922.108 Safari/537.36	YTo0OntzOjY6Il90b2tlbiI7czo0MDoieWhScm1BalJKdENoNnRJQlprWWhCdEQ1WTFIVGFXT0RpY2duM1h1UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQvYWJvdXQtdXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE1OiJ0cmFja2VkX3Nlc3Npb24iO2I6MTt9	1788755341
ENuv1262aszWbzNqU1vzldjgCteqLH9WsWfxSv8G	\N	172.204.28.237	Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot	YTozOntzOjY6Il90b2tlbiI7czo0MDoiY3pOS1VNR3R0ZURhU1I3d0ZqbFlqeE1md0lieGNiNVRyTGhHZEdYZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1788757110
QiLcjmBl9458Y34iljJ9Ct7MTGT44t0rD4PKczsK	\N	98.84.171.90	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoid3FQd0xuS1p0eHpCQ3l0QnY1UDc0RkJCQ1lYdjc3dGdoZXRGeXRUaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LmZ1dHVyZWNsb3VkLmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1788747909
0ENFVjzdvdZLB4ImNlF09OYqlQR2ngEl8S9vq9nq	\N	66.249.71.171	Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)	YTozOntzOjY6Il90b2tlbiI7czo0MDoiZHJ3anFlTDFSRmxoeU80ODF6Vk5GVFNsQjBmMnU3WG1LNnNRZTZCMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQvYWJvdXQtdXMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1788755338
4fgRoZFD7W8FTaTdnPFMTy6SX53D6pYMhpxORnaa	\N	173.252.82.68	facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)	YTozOntzOjY6Il90b2tlbiI7czo0MDoicTlpUWI3RFdlTkhTcHBubzYyaHNzeTJpNkp1WVd5dEZ1NmU2UWhVdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1788757326
IIqWdmGO7BjYRV7xz6ZuS1CRzu9ocbSDwhTXgjH6	\N	69.63.184.7	facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)	YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzBncjhybUJHaEhqYjJaRDZTbzhNR0ttYWtGUDZnajhoU2kxSW90OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1788752982
QImKFgrYCGQlD6rz1J0xmy5t6sAYYoZHSdHrywjG	10	103.147.8.141	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0	YTo1OntzOjY6Il90b2tlbiI7czo0MDoibjZFNDVGNG9vUjZkY1VQMUVDT2dsN2laRFltMGJRUkdEQTJPaTVKSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQvY2xpZW50LWFyZWEvc2FhcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MTU6InRyYWNrZWRfc2Vzc2lvbiI7YjoxO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=	1788756748
WBJO3EtvU3BkTnDXVPxPY6B5FE16P9yU14TU8f7D	\N	173.252.82.18	facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)	YTozOntzOjY6Il90b2tlbiI7czo0MDoiaXlqc3gwbUh4dDdEckNoTllzQzdnU0VtYlBGaldDNnlLYzNRd1ZVMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1788757326
Fw1lfShoUf2yQkT9d5OaaL4hm4adychNtfj89D2X	\N	66.249.79.32	Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/151.0.7922.173 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)	YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGtjakJpcXRpWEFxMXRyWjhaZmVpdkp4dm1tMWVueDJCaDEwRHpxNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQvc2Fhcy9zc2wtY2VydGlmaWNhdGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1788754156
sVHmHQG77ZENSubtn2JtZkLXS5BXIdZwNDm3h6go	\N	66.220.149.20	facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)	YTozOntzOjY6Il90b2tlbiI7czo0MDoiV2h6RUlNNW14UWFMaGM2M3N4UHZSdXNOTzkyWGU0QkQ3bllZMTNPVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1788756864
k75wILgObLaInS3sCWRfOmkjKiCGKq0uF0517JY8	1	103.147.8.141	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0	YTo1OntzOjY6Il90b2tlbiI7czo0MDoicjl0bXd3bkFSTVhDOWI1b0tlRUNlOUxJcUNDdTFKN2hIVXdwRzFYUiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNjoiaHR0cHM6Ly93d3cuZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjE1OiJ0cmFja2VkX3Nlc3Npb24iO2I6MTt9	1788757794
R1aCXCO1ucwajDuR3uGrKNoPegzNZj9etEHc7xlH	\N	66.220.149.32	facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)	YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2w4RUxoMVo4dFZIWEFZaHllZWYzWUdxamJ0NW1tTThvUTlGRHh0WCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1788756865
HDaWEWQiW42DlBrYWPc52vqq5YZBb36PBLo6D546	\N	51.81.169.203	Mozilla/5.0 (compatible; AhrefsBot/7.0; +http://ahrefs.com/robot/)	YTozOntzOjY6Il90b2tlbiI7czo0MDoicmJyeXljU2kyd3dPT0MzODE5c0dLWTlmUVFiNEFxQ3ppSE1PVjhZWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vd3d3LmZ1dHVyZWNsb3VkLmlkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1788757891
\.


--
-- Data for Name: subscriptions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subscriptions (id, user_id, type, name, price, reg_date, due_date, ip_address, status, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: ticket_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.ticket_messages (id, ticket_id, user_id, admin_id, message, attachment, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: tickets; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tickets (id, user_id, subject, status, priority, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at, google_id, avatar, godaddy_shopper_id, phone, address, city, province, postal_code, country_code, username, first_name, last_name, role, company_name, phone_number, partner_status, is_banned) FROM stdin;
2	bilker bilker	billywicaksono0@gmail.com	2025-12-01 11:43:38	$2y$12$3mHs2.VbwMwNr7BQTErViu8/X4yugV9jTtguHXwpPb3nq6PpxLjte	\N	2025-12-01 11:43:38	2025-12-01 11:43:39	\N	\N	PENDING-772800	\N	\N	\N	\N	\N	ID	bilker	bilker	bilker	user	\N	\N	\N	f
4	FutureCloud Admin	admin@futurecloud.id	\N	$2y$12$n9yBXM0IWnViB5mecon75u3XfDAqZr8vFdMP3ltF4f1kgW8U9f6TK	\N	2025-12-04 13:55:07	2025-12-04 13:55:07	\N	\N	\N	\N	\N	\N	\N	\N	ID	\N	FutureCloud	Admin	user	\N	\N	\N	f
6	Ghryshvi Dzickra	ghryshvi.dzickra@gmail.com	2025-12-08 09:20:54	$2y$12$M3yEcsgt4IZL2bBxlPYmd.sdf40JmZSdeTGWtJ.C6O4ngastlsQzK	\N	2025-12-08 09:20:54	2025-12-08 09:20:55	108152749421099382171	https://lh3.googleusercontent.com/a/ACg8ocLGv3ojLWsyCDMQz9RVPPtextm7ars4PypDugCWlvaOZWZ8SO7U=s96-c	GOOGLE-135401	\N	\N	\N	\N	\N	ID	ghryshvi5452	Ghryshvi	Dzickra	user	\N	\N	\N	f
7	PT BTT	ptbtt01@gmail.com	2025-12-13 03:36:05	$2y$12$FSXsc9wvcHguNXaNf0gAVOEpFVWS4G.ytHTcU0Phw4TiuzrpiLT2q	\N	2025-12-13 03:36:05	2025-12-13 03:36:05	109946949967456860020	https://lh3.googleusercontent.com/a/ACg8ocIXe3feuYgk9BdGDPTurvk0UnOrhp4jlw54SQ1gaJHypiFVtg=s96-c	GOOGLE-460208	\N	\N	\N	\N	\N	ID	pt7723	PT	BTT	user	\N	\N	\N	f
11	Customer Ketiga	client3@example.com	2025-12-13 10:44:18	$2y$12$l.4vmXfMWtwLO.gMPBGR6uSQWJsKsxVpWIpB7swaTwAGBx8WNlFda	\N	2025-12-13 10:44:18	2025-12-13 10:44:18	\N	\N	\N	\N	\N	\N	\N	\N	ID	\N	Customer	Ketiga	user	\N	\N	\N	f
15	Admin FKUB Jakpus	info@fkubjakpus.or.id	2025-12-17 13:03:44	$2y$12$2WfvPsD6FYkNRQnM7QKc0OfEDyitcczoS.iIog2qr7mV3kLrl7i4S	\N	2025-12-16 12:28:24	2025-12-17 13:03:44	\N	\N	\N	\N	\N	\N	\N	\N	ID	fkubjakpus	Admin	FKUB Jakpus	user	\N	\N	\N	f
5	gispi wibu	gispiwibu@gmail.com	2025-12-05 09:18:46	$2y$12$IHlXzoSm09zIvUozmKltA.5wbogtA2A0wVWWRh8hmpL2JoZqwBQ.u	\N	2025-12-05 09:18:46	2025-12-17 13:30:15	109054687011289659101	https://lh3.googleusercontent.com/a/ACg8ocJqU5527ZmD7aN4pQ9gniSolUE2mXgFDG6KjfmPy-zb5xLdFQ=s96-c	GOOGLE-281500	\N	\N	\N	\N	\N	ID	gispi2753	gispi	wibu	user	\N	\N	\N	t
1	FutureCloud Official	gispi.desu@gmail.com	2025-12-01 11:23:44	$2y$12$KN75Gx4th/xxh5ZIbaulJuI1f3jxLoZcuj8CVh8W.CpWiYyWm3BDK	\N	2025-12-01 11:23:44	2025-12-19 12:38:50	115999999275364563672	https://lh3.googleusercontent.com/a/ACg8ocJJUr5dJ2KHrzl4WagtSxYzs0xDtgw2HX_4usqEiizUUpQbLLQY=s96-c	GOOGLE-523825	\N	Alamat Saya	\N	\N	\N	ID	ghryshvi9022	Ghryshvi	Dzickra	partner	PT Maju Terdepan	083234562456	approved	f
16	Syahfiq Hikmal	dikasyahfiq@gmail.com	2026-02-06 00:41:23	$2y$12$456G9fVo1R3sFgQTaAxYvewVs6U/algrS/QH6CvVhzT25.nCxiCGG	\N	2026-02-06 00:41:23	2026-02-06 00:41:25	\N	\N	PENDING-617160	\N	\N	\N	\N	\N	ID	makina	Syahfiq	Hikmal	user	\N	\N	\N	f
17	Samsul Bahri	sam.bachri91@gmail.com	2026-03-16 05:16:34	$2y$12$z/PHzKE1KVi67M72erhIn.m8z1w3/fRv9Hi/gyOOAQmjEInQVUpNS	oxYfMay4GS8vAd7VfCsUV8r7rDD9L39fVFio7gR1ViNolN0u1AUHi12IW3IO	2026-03-16 05:16:34	2026-03-16 09:03:27	\N	\N	PENDING-191980	\N	Gedung ABC, Kemang, jakarta selatan	\N	\N	\N	ID	sam99	Samsul	Bahri	user	PT ABC	081383659456	pending	f
12	Muhamad Nur Salam	aaallaaamm03@gmail.com	2025-12-16 09:49:33	$2y$12$Nd.hsNjkhu1qw7KUGhKgFuBPTZ6VdfFmrPZpCNz8ZhHTi1ecqNnnu	\N	2025-12-16 09:49:33	2026-06-03 06:54:36	111426406043668453037	https://lh3.googleusercontent.com/a/ACg8ocJJagA27yrJ8szuqqO7z94RbEbo5EOQK6WySQZGCYPMuh6jmLI=s96-c	GOOGLE-761302	\N	\N	\N	\N	\N	ID	aaallaaamm03	Muhamad	Nur Salam	user	\N	\N	\N	f
18	BILLY WICAKSONO	billywicaksono.xtkja@gmail.com	2026-06-03 07:20:28	$2y$12$eBdDWRpYjf/DH44N4PuCfeNKLeP6D/wfrbPLXZwMaOmNiKY5tKz3q	\N	2026-06-03 07:20:28	2026-06-03 07:20:30	100368139665730022809	https://lh3.googleusercontent.com/a/ACg8ocJdTDL9tRTcLvZMBkpC3LM8erqHJaDgbdCJrlf5segqgqT01Q=s96-c	GOOGLE-253041	\N	\N	\N	\N	\N	ID	billy5227	BILLY	WICAKSONO	user	\N	\N	\N	f
19	AFSAL PRIMA MAULA	afsalprimamaulaaa@gmail.com	2026-06-03 07:55:26	$2y$12$tMYm.gpHzSIh.tWFZSEnHO65SIchY11xmCcO/RdekQ0dIwdnzjLFK	\N	2026-06-03 07:55:26	2026-06-03 07:55:27	118137656745985944252	https://lh3.googleusercontent.com/a/ACg8ocKXkt7yET_uCd7N0IaAnaxzwqL90WZ266xFjuQV33h2NyFrt3w=s96-c	GOOGLE-418268	\N	\N	\N	\N	\N	ID	afsal8096	AFSAL	PRIMA MAULA	user	\N	\N	\N	f
20	Muhammad Faisyal	faisyalnur04@gmail.com	2026-07-11 04:59:57	$2y$12$FkzVrNYdhV67QUF3ITa7ye5asjP1zqxTMpMPP8Jzi82/fBpIPROzm	\N	2026-07-11 04:59:57	2026-07-11 04:59:57	114957984381705650933	https://lh3.googleusercontent.com/a/ACg8ocJzWVFVeevrgAYLAzCnLUo4k1xSH4JvN7fEzYBYSp0d9U-7TcY=s96-c	GOOGLE-320095	\N	\N	\N	\N	\N	ID	muhammad9348	Muhammad	Faisyal	user	\N	\N	\N	f
21	Billy Wicaksono	billywicaksono.999@gmail.com	2026-07-14 14:18:10	$2y$12$NxfWQ2neEbIGFSgqYjYYm.C97tyo5Vx9HVJLpMZL5p0LGCpoPoiC2	\N	2026-07-14 14:18:10	2026-07-14 14:18:10	100819198505136043372	https://lh3.googleusercontent.com/a/ACg8ocKZiuCK6-oVNVujTtjJktpjpTLMnR6n9dhGC98v6kf8WPtQOb__=s96-c	GOOGLE-591626	\N	\N	\N	\N	\N	ID	billy9401	Billy	Wicaksono	user	\N	\N	\N	f
10	Admin DNY Filter	info@dny-filterindo.co.id	2025-12-17 13:03:43	$2y$12$ddarVCzLsemVd10doapgMOGhR3NGrC5pR5jZwvwkrX6IksvLgvO0m	Jq8gM1ubzg0yGj0612NiS1r42nlIyRNnfQKTAI7R80s9QYw0dho4KAN2l1TZ	2025-12-13 10:44:18	2025-12-17 13:03:43	\N	\N	\N	\N	\N	\N	\N	\N	ID	dnyfilterindo	Admin	DNY Filter	user	\N	\N	\N	f
23	Smart Track	idsmartrack@gmail.com	2026-08-14 08:57:06	\N	\N	2026-08-14 08:57:06	2026-08-14 08:57:07	108617437861566296764	https://lh3.googleusercontent.com/a/ACg8ocKbLVa0TlLouOmGN8I-JtzxyDiPKO35O5pzpdMrcHufZ163Kw=s96-c	GOOGLE-172937	\N	\N	\N	\N	\N	ID	smart4167	Smart	Track	user	\N	\N	\N	f
22	ptbtt	ptbtt02@gmail.com	2026-08-03 10:37:40	$2y$12$PfPpHhKYclHmjH/jP0IJX.n5VTphwtUW6RK/9.mtR0iFhYNcP.XTK	Urpm78Mb2nmQPNuCMLKtgvGsbZhOsdfALuqPnQ0GI3MXYitRVmOMez1puifo	2026-08-03 10:37:40	2026-08-04 16:41:08	110322260369916538950	https://lh3.googleusercontent.com/a/ACg8ocJ8KObQ1ZBY1citr5unHZMC5ff9L3F5ml3lFcXrK6TkrKrbAg=s96-c	GOOGLE-337509	\N	\N	\N	\N	\N	ID	ptbtt02	pt	btt	user	\N	\N	\N	f
9	Admin Sixperience	info@sixperience.id	2025-12-17 13:03:43	$2y$12$880xUmx3SiyDv5XeAuoMGurZFgZ/B6e6i3kSHBukDDjBKcAWRwjSS	6vFfCooRsW0tjs2paG5lJqduQfpGEuOihK56CDYxz4uG33GobqPzRAeuprFW	2025-12-13 10:44:18	2025-12-17 13:03:43	\N	\N	\N	\N	\N	\N	\N	\N	ID	sixperience	Admin	Sixperience	user	\N	\N	\N	f
\.


--
-- Data for Name: visitor_logs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.visitor_logs (id, session_id, ip_address, date, page_journey, created_at, updated_at) FROM stdin;
30	STwYiC3AIzRhgWmYsaKIjchPcZDGo2QDLKDRku8j	140.213.46.222	2026-03-15	[{"path":"\\/","time":"14:48"}]	2026-03-15 14:48:07	2026-03-15 14:48:07
10	vGJkxsKES50ap6zOv7GBDI3ZQqC9Wd95fHyH3Fj1	114.10.149.198	2026-03-14	[{"path":"\\/admin\\/dashboard","time":"01:33"},{"path":"\\/admin\\/monitoring","time":"01:33"},{"path":"\\/admin\\/chatbot\\/responses","time":"01:33"},{"path":"\\/admin\\/chatbot\\/history","time":"01:33"}]	2026-03-14 01:33:07	2026-03-14 01:33:32
1	IJxfJ5fCKvewmrLoYUn8WEfkVzKXC1SFmj1MJ3JV	114.10.149.198	2026-03-13	[{"path":"\\/admin\\/dashboard","time":"13:06"},{"path":"\\/admin\\/chatbot\\/history","time":"13:10"},{"path":"\\/admin\\/chatbot\\/responses","time":"13:14"},{"path":"\\/admin\\/orders","time":"13:19"},{"path":"\\/admin\\/products","time":"13:19"},{"path":"\\/admin\\/portfolios","time":"13:19"},{"path":"\\/admin\\/users","time":"13:19"},{"path":"\\/admin\\/portfolios","time":"13:20"},{"path":"\\/admin\\/users","time":"13:20"},{"path":"\\/admin\\/admins","time":"13:20"},{"path":"\\/admin\\/partners","time":"13:20"},{"path":"\\/admin\\/hero","time":"13:20"},{"path":"\\/admin\\/dashboard","time":"13:20"},{"path":"\\/admin\\/monitoring","time":"13:30"},{"path":"\\/admin\\/chatbot\\/responses","time":"13:30"},{"path":"\\/","time":"13:30"},{"path":"\\/admin\\/dashboard","time":"14:02"},{"path":"\\/admin\\/chatbot\\/responses","time":"14:02"},{"path":"\\/admin\\/chatbot\\/history","time":"14:03"},{"path":"\\/admin\\/chatbot\\/responses","time":"14:14"},{"path":"\\/","time":"14:14"},{"path":"\\/admin\\/dashboard","time":"14:24"},{"path":"\\/admin\\/chatbot\\/history","time":"14:25"},{"path":"\\/admin\\/chatbot\\/responses","time":"14:25"},{"path":"\\/admin\\/monitoring","time":"14:26"}]	2026-03-13 13:06:25	2026-03-13 14:26:20
3	2B12Nf9U2lhVpnVU3r1GcxtO3lvD4C8cAjd1X6Ys	66.249.74.162	2026-03-13	[{"path":"\\/","time":"17:01"}]	2026-03-13 17:01:56	2026-03-13 17:01:57
4	wTyxlJdoQENyKH4WxzI1dd2Hb0Y7WH8R6HfdDDX7	66.249.73.4	2026-03-13	[{"path":"\\/forgot-password","time":"18:16"}]	2026-03-13 18:16:56	2026-03-13 18:16:56
5	wUR8WtjDnBXhalMUNP4h72GWlw31BnABmj4NtoCL	66.249.73.235	2026-03-13	[{"path":"\\/vps-hosting","time":"19:32"}]	2026-03-13 19:32:02	2026-03-13 19:32:02
6	BxrriYVdfbqOgQQhuAGkXVkJwJtDOl6aCtRJ6Gxe	66.249.73.235	2026-03-13	[{"path":"\\/order\\/domain","time":"20:46"}]	2026-03-13 20:46:58	2026-03-13 20:46:59
2	znT3hdaydcHeEn72Fc77nVkTaSxs3SnXrKrBpeIb	114.10.157.148	2026-03-13	[{"path":"\\/","time":"13:28"}]	2026-03-13 13:28:03	2026-03-13 13:28:03
7	H6PUsDKQPnd6tQdBL2Fq5KSYlvDzv2tWmkPgIa88	40.77.167.70	2026-03-13	[{"path":"\\/","time":"21:13"}]	2026-03-13 21:13:48	2026-03-13 21:13:48
8	yxugdzWX1tbxo9TuiMSjrS9DgJfKNgl31XB2IKRt	66.249.65.101	2026-03-13	[{"path":"\\/","time":"22:23"}]	2026-03-13 22:23:43	2026-03-13 22:23:43
23	x2EjA4vU3A5omD115JsstE4Jx6G49UL6vkxTqfB4	114.5.208.46	2026-03-14	[{"path":"\\/register","time":"13:39"},{"path":"\\/otp-verify","time":"13:39"}]	2026-03-14 13:39:08	2026-03-14 13:39:40
9	FdKiVCC2ij9PXEBGaQaa2NAxkrLPl7iPVVHfbg3g	114.10.156.34	2026-03-14	[{"path":"\\/","time":"01:14"},{"path":"\\/about-us","time":"01:15"}]	2026-03-14 01:14:47	2026-03-14 01:15:10
12	8Et2IycrPDqqZd353q6SQ7SvPXcswjKfQkbGPy7i	35.165.215.140	2026-03-14	[{"path":"\\/","time":"04:12"}]	2026-03-14 04:12:09	2026-03-14 04:12:10
13	0nYvXZbyTndpfEXvp0sYdiqNjfVMl3j8EQeIFTIJ	66.249.73.235	2026-03-14	[{"path":"\\/about-us","time":"05:10"}]	2026-03-14 05:10:07	2026-03-14 05:10:07
11	xOXXMP1lHQB6pu8kXol4tervlQSqthPy4QDGOoWz	66.249.73.235	2026-03-14	[{"path":"\\/order\\/domain","time":"03:55"},{"path":"\\/vps-hosting","time":"08:39"}]	2026-03-14 03:55:06	2026-03-14 08:39:57
24	zI58pc2gdiFN2hLwYPchcNYQaPjB6onS6HAAfzvN	66.249.73.234	2026-03-14	[{"path":"\\/services","time":"14:38"}]	2026-03-14 14:38:36	2026-03-14 14:38:37
18	KGUfOb3rntMXYnz7UBQ6fLgpE8x6JA5ANGqCNT7s	18.246.169.26	2026-03-14	[{"path":"\\/","time":"09:39"}]	2026-03-14 09:39:23	2026-03-14 09:39:23
16	0ynZ3NXJmTXLx9VNnfggZ3ZEuxMFhLpYzHFc2gKs	114.5.208.46	2026-03-14	[{"path":"\\/admin\\/dashboard","time":"07:01"},{"path":"\\/admin\\/orders","time":"07:01"},{"path":"\\/","time":"08:13"},{"path":"\\/terms","time":"08:14"},{"path":"\\/register","time":"08:15"},{"path":"\\/contact","time":"08:16"},{"path":"\\/register","time":"08:57"},{"path":"\\/","time":"09:40"}]	2026-03-14 07:01:14	2026-03-14 09:40:03
14	JGYGP8KVQds5Z1oSoEZioyVJrTUrk7iEIvaUkjfj	114.10.144.198	2026-03-14	[{"path":"\\/","time":"05:42"},{"path":"\\/login","time":"05:59"},{"path":"\\/","time":"06:11"},{"path":"\\/faq","time":"06:20"},{"path":"\\/refund-policy","time":"06:21"},{"path":"\\/terms","time":"06:21"},{"path":"\\/faq","time":"06:22"}]	2026-03-14 05:42:41	2026-03-14 06:22:16
15	BxrriYVdfbqOgQQhuAGkXVkJwJtDOl6aCtRJ6Gxe	66.249.73.236	2026-03-14	[{"path":"\\/order\\/vps","time":"06:25"}]	2026-03-14 06:25:03	2026-03-14 06:25:04
19	4yvWV1UiRCi8EnG5XUJbWJD9asd219hn9N12DIDl	66.249.73.234	2026-03-14	[{"path":"\\/order\\/vps","time":"09:55"}]	2026-03-14 09:55:09	2026-03-14 09:55:09
17	15cPyrYjPT0l4pPQ1vGBcEOoyR34z6kWmJRWvU7D	66.249.73.4	2026-03-14	[{"path":"\\/register","time":"08:01"}]	2026-03-14 08:01:10	2026-03-14 08:01:10
20	Hgz3T5IdR3kTkMazxCumtJMBBZpQSVpWi5aoaorP	54.174.150.36	2026-03-14	[{"path":"\\/","time":"11:48"}]	2026-03-14 11:48:46	2026-03-14 11:48:46
21	Fs5B2APdhBXhIZJiNUT4hUeNQxWfAioTDdae2j9r	66.249.73.4	2026-03-14	[{"path":"\\/","time":"12:08"}]	2026-03-14 12:08:40	2026-03-14 12:08:40
22	IcT0w1hCf55kuWf21TveiW5EgRh06afe60nwDAsb	112.215.211.92	2026-03-14	[{"path":"\\/","time":"13:37"}]	2026-03-14 13:37:50	2026-03-14 13:37:50
25	HDjQyijKiEvOcN3R5AprfbG7x9aRAZ0nHm34qnnK	66.249.74.162	2026-03-14	[{"path":"\\/","time":"15:25"}]	2026-03-14 15:25:28	2026-03-14 15:25:28
26	dk82oTovtpkhE0lyHJwXeX77vnupzMkjbG5YhJfE	66.249.71.203	2026-03-14	[{"path":"\\/","time":"15:45"}]	2026-03-14 15:45:18	2026-03-14 15:45:19
27	bEXogVUUuIkAjK6is2imZIVdpvPIGtyxbWoV0Ilt	107.174.109.6	2026-03-14	[{"path":"\\/","time":"21:38"}]	2026-03-14 21:38:46	2026-03-14 21:38:47
28	fQUihqnQXhj2NNIJAe8qE3gfuMcJGUae63wLQ0qt	140.213.38.240	2026-03-15	[{"path":"\\/register","time":"01:51"}]	2026-03-15 01:51:21	2026-03-15 01:51:23
29	CuC0rUxkvRbhnAfQByNAdRmk5RxtcQkdVHryhLPw	52.167.144.186	2026-03-15	[{"path":"\\/","time":"05:07"}]	2026-03-15 05:07:56	2026-03-15 05:07:56
31	tafI6D8gkC5oQ0UfjOsOa5A1gtIlOkcSG7WsiRDy	114.10.45.96	2026-03-15	[{"path":"\\/","time":"14:49"}]	2026-03-15 14:49:04	2026-03-15 14:49:04
32	OaUoBvRXhukMySV700AOlOOkrbEhFJLB1uJofisZ	66.249.71.202	2026-03-15	[{"path":"\\/","time":"15:35"}]	2026-03-15 15:35:02	2026-03-15 15:35:03
33	BjiU9lfKKJKDzzOMUhNKIwRF7k6Nrv4uE54k1jko	66.249.71.128	2026-03-15	[{"path":"\\/register","time":"20:16"}]	2026-03-15 20:16:49	2026-03-15 20:16:49
34	VNzeLoFx98db6VdSgkSipRl8p5vlUusqaT3AJqIW	66.249.74.163	2026-03-15	[{"path":"\\/","time":"20:24"}]	2026-03-15 20:24:29	2026-03-15 20:24:30
35	HUIQ0OE66aETbSSWloMuxUwxx8HNBpoq7smIILgg	66.249.65.101	2026-03-15	[{"path":"\\/","time":"22:54"}]	2026-03-15 22:54:28	2026-03-15 22:54:28
36	Y38kbPPwfDDgSN2G6nCQVZqBBI3sPkblbLsxHKnp	40.77.167.5	2026-03-16	[{"path":"\\/catalog","time":"00:27"}]	2026-03-16 00:27:35	2026-03-16 00:27:35
37	AowQVHG8nKhaZnk7cWJ3eXwKRAhgwjD9hnRWODVy	66.249.73.234	2026-03-16	[{"path":"\\/services","time":"01:29"}]	2026-03-16 01:29:19	2026-03-16 01:29:19
38	abdYMLJtIC3qqhYER5kUX46kCs51w59WeBArxEne	114.10.76.128	2026-03-16	[{"path":"\\/","time":"02:01"}]	2026-03-16 02:01:22	2026-03-16 02:01:22
39	DX8QVnNTKRN3VzVeH94ZCaATE0b74OyCxVowJH3E	180.254.12.25	2026-03-16	[{"path":"\\/","time":"02:34"},{"path":"\\/catalog","time":"02:36"}]	2026-03-16 02:34:56	2026-03-16 02:36:21
91	vcT0UUVT4EKOD2ms67xK4kPtzlitpOnnBDHtpJwm	185.117.225.57	2026-03-23	[{"path":"\\/","time":"03:26"}]	2026-03-23 03:25:59	2026-03-23 03:26:01
93	0Rkvk2huPkRnmYfPUuGjJ3ae9imxnE96WkUB3Cno	66.249.71.128	2026-03-24	[{"path":"\\/","time":"12:13"}]	2026-03-24 12:13:09	2026-03-24 12:13:09
45	GWolAzze52u4PXbxWCePzlrToW0XZSHxihQZUAV5	17.241.75.6	2026-03-16	[{"path":"\\/services","time":"07:32"}]	2026-03-16 07:32:21	2026-03-16 07:32:21
95	X8K7ZfNAsC6sLSPh8BupMYW61vJH8AtgkTkpomJ4	17.22.245.109	2026-03-24	[{"path":"\\/","time":"14:51"}]	2026-03-24 14:51:39	2026-03-24 14:51:40
97	3V92nzFi1hodNmd1ATzT3tFzr2XbGOwqyWa9uSIa	17.241.227.111	2026-03-24	[{"path":"\\/about-us","time":"15:15"}]	2026-03-24 15:15:41	2026-03-24 15:15:41
41	yxugdzWX1tbxo9TuiMSjrS9DgJfKNgl31XB2IKRt	66.249.65.101	2026-03-16	[{"path":"\\/services","time":"05:01"}]	2026-03-16 05:01:28	2026-03-16 05:01:28
40	9iLy6LY9QUkQVd1KcpPH0nAqYaESHXUO6m8uK3Cc	182.2.191.116	2026-03-16	[{"path":"\\/","time":"03:21"},{"path":"\\/catalog","time":"03:31"},{"path":"\\/services","time":"03:32"},{"path":"\\/about-us","time":"03:32"},{"path":"\\/contact","time":"03:32"},{"path":"\\/faq","time":"03:33"},{"path":"\\/","time":"03:33"},{"path":"\\/about-us","time":"03:36"},{"path":"\\/services","time":"04:57"},{"path":"\\/about-us","time":"04:59"},{"path":"\\/register","time":"05:05"},{"path":"\\/otp-verify","time":"05:15"}]	2026-03-16 03:21:12	2026-03-16 05:15:51
42	498dhqy18WgcoVsq85TU0oCGqTldzFsXZPBZWUJu	182.2.191.116	2026-03-16	[{"path":"\\/","time":"05:16"}]	2026-03-16 05:16:49	2026-03-16 05:16:49
99	r9xY2pMbUIkLiGbqbNEWlFdS0tkQwx940ajKJ9gv	182.253.150.0	2026-03-25	[{"path":"\\/","time":"06:21"}]	2026-03-25 06:21:37	2026-03-25 06:21:37
43	TErB9YdxCoW9wF6ZtxqFgwKlHzp8yveD4BeJQ2k3	182.2.191.116	2026-03-16	[{"path":"\\/","time":"05:22"},{"path":"\\/register","time":"05:22"},{"path":"\\/login","time":"05:40"}]	2026-03-16 05:22:22	2026-03-16 05:40:06
101	i0rUwAy1BEkWLWeW3mxqRJJbF4OIyAgc5fvdAcWh	114.10.156.94	2026-03-25	[{"path":"\\/","time":"07:41"}]	2026-03-25 07:41:18	2026-03-25 07:41:18
103	BuYBUYgLQLmbZEfUYP1tIaMhZa6ScDfx4fDd8cRu	114.10.45.192	2026-03-25	[{"path":"\\/about-us","time":"09:09"}]	2026-03-25 09:09:33	2026-03-25 09:09:33
105	V0J7kVNFnh4mDYGRbiQHovQCS9axraYd6scxeWmV	52.167.144.229	2026-03-25	[{"path":"\\/catalog","time":"21:23"}]	2026-03-25 21:23:34	2026-03-25 21:23:34
107	ShtYgP9Muf0NE26TLPAxYWUTf52V4aIQrrPlUF7e	66.249.73.6	2026-03-26	[{"path":"\\/","time":"07:39"}]	2026-03-26 07:39:05	2026-03-26 07:39:05
127	Q7vhwqaMidJ3IdnuHbyElSkvpS71PO9OoW8rIFCF	17.22.253.18	2026-03-30	[{"path":"\\/domain-registration","time":"18:45"}]	2026-03-30 18:45:59	2026-03-30 18:45:59
109	ShtYgP9Muf0NE26TLPAxYWUTf52V4aIQrrPlUF7e	66.249.73.7	2026-03-27	[{"path":"\\/vps-hosting","time":"14:51"},{"path":"\\/order\\/domain","time":"19:51"}]	2026-03-27 14:51:22	2026-03-27 19:51:21
111	rSakjXu0PWOkqk5fV554CPCKDxS7atM0Yn3pmJdP	40.77.167.16	2026-03-27	[{"path":"\\/about-us","time":"20:50"}]	2026-03-27 20:50:34	2026-03-27 20:50:34
129	ZsOxSsuPZBL4iYA778u6aFjBdQOzyhwAOAufE7pD	66.249.74.33	2026-03-31	[{"path":"\\/","time":"07:15"}]	2026-03-31 07:15:45	2026-03-31 07:15:45
113	z3qIOOwtd9hN1owDj5vnnBATPIF5Ygjew2uyx1tz	66.249.73.6	2026-03-28	[{"path":"\\/about-us","time":"08:58"},{"path":"\\/order\\/vps","time":"10:13"},{"path":"\\/order\\/domain","time":"11:28"},{"path":"\\/order\\/cpanel","time":"13:58"}]	2026-03-28 08:58:30	2026-03-28 13:58:26
115	15OtxkCDfNgvj9ETDBHXFrrRpcAOfkZYqDs9lRxj	66.249.74.37	2026-03-28	[{"path":"\\/catalog","time":"15:13"}]	2026-03-28 15:13:56	2026-03-28 15:13:57
131	QRgbQBPugbbWHgt42stOm2p5jJ0b2SoiognmXxiw	64.64.112.153	2026-03-31	[{"path":"\\/","time":"17:10"}]	2026-03-31 17:10:22	2026-03-31 17:10:23
117	NGKxFidDhPVjdUDKlHTQjPKlduuPwUMQ0NaIeLoq	182.253.228.98	2026-03-28	[{"path":"\\/","time":"16:44"},{"path":"\\/login","time":"17:04"},{"path":"\\/","time":"17:49"}]	2026-03-28 16:44:48	2026-03-28 17:49:29
119	KCkYWqiybjSvZJyagvlNcNFi34SR2oLCeRVtiK1K	103.136.220.232	2026-03-29	[{"path":"\\/","time":"00:32"}]	2026-03-29 00:32:51	2026-03-29 00:32:51
121	gscUwnTwU1G0mp53rYKEelX8VwDAY2WqgKn1EQzx	182.2.185.19	2026-03-30	[{"path":"\\/client-area","time":"01:52"}]	2026-03-30 01:52:42	2026-03-30 01:52:43
123	kfCpF9JbluSOwf9JYphfQ1a4ZtEtEiogrkhJngQ5	66.249.74.36	2026-03-30	[{"path":"\\/","time":"15:49"}]	2026-03-30 15:49:31	2026-03-30 15:49:31
125	tojw4bzcb8DCe5k2d2f3z8xV2LD5Ca0FpLPjSScm	114.10.28.162	2026-03-30	[{"path":"\\/about-us","time":"17:48"}]	2026-03-30 17:48:13	2026-03-30 17:48:13
133	oUiCIMhLQ18LUVz8eA2ItEHc3qw1ozL0ZgLrSzqU	74.7.227.47	2026-03-31	[{"path":"\\/about-us","time":"19:58"}]	2026-03-31 19:58:41	2026-03-31 19:58:41
135	nZA2pXLu9XiWx3FKJIk1IZNqqFZ21gepT2ghIAVQ	66.249.71.137	2026-04-01	[{"path":"\\/","time":"07:18"}]	2026-04-01 07:18:50	2026-04-01 07:18:51
137	4BVfDIT19EEXWlBkjeeSP0MXfguKTl5j9F8HCb7S	66.249.73.6	2026-04-02	[{"path":"\\/forgot-password","time":"08:34"}]	2026-04-02 08:34:21	2026-04-02 08:34:22
139	oeCeFbc0y1DofF4xbv0KQFedTGJA6NzGPzgWTlf7	66.249.73.6	2026-04-02	[{"path":"\\/","time":"09:50"}]	2026-04-02 09:50:26	2026-04-02 09:50:26
141	bl2RnfeWcC4uDbbN3V7lRL7JtgQIf37zeF8UCGMf	66.249.73.196	2026-04-03	[{"path":"\\/","time":"12:40"}]	2026-04-03 12:40:23	2026-04-03 12:40:23
143	11HjWVEWrQjTZhF8Fs97Y6ofZoqWhJQxps5OxRfs	182.253.228.96	2026-04-04	[{"path":"\\/","time":"04:32"}]	2026-04-04 04:32:24	2026-04-04 04:32:26
145	ASOS5RBZDRmju2ceDQQaD3WmTdC85xkPedCphsXl	17.22.237.213	2026-04-04	[{"path":"\\/faq","time":"07:48"}]	2026-04-04 07:48:13	2026-04-04 07:48:14
147	H8ChR5zMY3rfDSmcp241xFB9I8MgHe6ejjkEDdiF	182.253.228.99	2026-04-04	[{"path":"\\/","time":"11:58"}]	2026-04-04 11:58:41	2026-04-04 11:58:42
149	umOHZMhGiFHbK29eVm86uQkpV4MhLrDM6b9azkD7	114.10.7.218	2026-04-06	[{"path":"\\/","time":"06:18"}]	2026-04-06 06:18:57	2026-04-06 06:18:57
151	71eYWvPW9noTNBV1oRf73K92ZiaQIWkRY5WUHG8T	17.22.253.40	2026-04-06	[{"path":"\\/saas-marketplace","time":"21:53"}]	2026-04-06 21:53:27	2026-04-06 21:53:27
153	0RCcYZGvM652HFNwHeXNO9uUoPboLnzarzqRXqF6	17.22.237.187	2026-04-08	[{"path":"\\/refund-policy","time":"00:27"}]	2026-04-08 00:27:27	2026-04-08 00:27:27
155	ivCFwrBvG7XwUIpWWGwDbVu0eZPXuHhbfjRkENCw	36.68.132.14	2026-04-08	[{"path":"\\/","time":"07:56"}]	2026-04-08 07:56:42	2026-04-08 07:56:42
157	Qh2GEfRHohd6hu1D39jIgVM8v1Ssoe2i4CgQxXSr	66.249.65.37	2026-04-08	[{"path":"\\/","time":"11:50"}]	2026-04-08 11:50:21	2026-04-08 11:50:22
159	63UPEk3qn9PcjzKD7QnQ0anrlyLTskl7pxTfViRf	216.218.191.202	2026-04-08	[{"path":"\\/","time":"13:45"}]	2026-04-08 13:45:37	2026-04-08 13:45:38
161	p68ssiyG8dkBCGGo95LlBY36wc398TLDCBXfBDx8	36.77.225.199	2026-04-09	[{"path":"\\/","time":"02:43"}]	2026-04-09 02:43:03	2026-04-09 02:43:04
163	20FlbueUI0Pp9UqbiOEUwVq81c66vPMjdNKYSWHF	66.249.65.37	2026-04-09	[{"path":"\\/vps-hosting","time":"10:14"}]	2026-04-09 10:14:37	2026-04-09 10:14:37
165	jK32OJ9pBxAOOIzZ2vSloErBa7s9QxEdnhsEf54w	17.241.75.234	2026-04-09	[{"path":"\\/forgot-password","time":"21:07"}]	2026-04-09 21:07:59	2026-04-09 21:07:59
167	JN8r6mxjJRDTF77m9MRj3u8jywfrlG1bBeLoSIO7	114.79.1.57	2026-04-10	[{"path":"\\/","time":"05:07"},{"path":"\\/vps-hosting","time":"05:08"},{"path":"\\/order\\/vps","time":"05:08"},{"path":"\\/services","time":"05:11"},{"path":"\\/portfolio","time":"05:11"}]	2026-04-10 05:07:36	2026-04-10 05:11:39
169	LFxRIiO93TBnQEIkNGNG34AIuRMNd8yqKBfjo1hj	1.32.219.175	2026-04-10	[{"path":"\\/","time":"14:25"}]	2026-04-10 14:25:54	2026-04-10 14:25:55
171	QMz2q7w8YI6WlU04fAvAGpzPeWk01N9HUuAYqFPg	66.249.71.129	2026-04-11	[{"path":"\\/","time":"17:47"}]	2026-04-11 17:47:30	2026-04-11 17:47:31
92	3cBOGLXBsH1E2o3u21ZEEmUMmKBDZB9RfAdznYSI	17.246.15.149	2026-03-23	[{"path":"\\/refund-policy","time":"11:09"}]	2026-03-23 11:09:57	2026-03-23 11:09:57
94	PDXgxj8kT5Pz9GaQkc2pI0qEAKUXZCErTXWpFBtl	17.246.15.187	2026-03-24	[{"path":"\\/","time":"13:01"}]	2026-03-24 13:01:25	2026-03-24 13:01:26
96	fMhIBY1AIUROXdXCTaQvrm0bCdLpvoLTDHYUr1q9	17.22.253.223	2026-03-24	[{"path":"\\/contact","time":"14:53"}]	2026-03-24 14:53:23	2026-03-24 14:53:24
98	QCnhwS2MePPmenT4GcBLPKdGc5mOYfCAxjNGaSl5	182.253.150.0	2026-03-25	[{"path":"\\/","time":"06:21"}]	2026-03-25 06:21:02	2026-03-25 06:21:02
100	5H1XQBW0DQ2lhhsFaTyVnFqyKzxKnAfeJUG7vyQr	182.253.150.0	2026-03-25	[{"path":"\\/","time":"06:23"}]	2026-03-25 06:23:52	2026-03-25 06:23:52
102	jnkQQDfkCwz6V96KgIt6uwAiKPSEGEV6BdAkV6fC	114.10.146.210	2026-03-25	[{"path":"\\/","time":"08:00"}]	2026-03-25 08:00:55	2026-03-25 08:00:55
104	orXO7NBtuIU43Me1LuQ0x6RSeAQTg82GSmPJ0R8q	140.213.51.193	2026-03-25	[{"path":"\\/","time":"13:11"}]	2026-03-25 13:11:33	2026-03-25 13:11:33
106	b29auWVZhcHQ9zLjAUBuL3ywezFZ177G2mgNN32F	17.246.23.111	2026-03-25	[{"path":"\\/terms","time":"23:21"}]	2026-03-25 23:21:44	2026-03-25 23:21:45
108	rNJBWF2Zv1esDcNBDrv1bfpyFBpdDlF0I3AxbLow	182.6.10.22	2026-03-27	[{"path":"\\/client-area","time":"00:36"}]	2026-03-27 00:36:12	2026-03-27 00:36:13
110	z3qIOOwtd9hN1owDj5vnnBATPIF5Ygjew2uyx1tz	66.249.73.6	2026-03-27	[{"path":"\\/services","time":"17:21"}]	2026-03-27 17:21:25	2026-03-27 17:21:26
112	oteh2Nfb9dh5twI7f1Zqo9ZpNo5mGvw2oFCy1IR8	66.249.71.128	2026-03-28	[{"path":"\\/","time":"00:06"}]	2026-03-28 00:06:32	2026-03-28 00:06:33
114	ShtYgP9Muf0NE26TLPAxYWUTf52V4aIQrrPlUF7e	66.249.73.6	2026-03-28	[{"path":"\\/contact","time":"12:43"}]	2026-03-28 12:43:31	2026-03-28 12:43:32
116	xXEX4WCWmwf8HJIJL8IJS1Xn8EpcMgrPrdqhhxO0	66.249.74.36	2026-03-28	[{"path":"\\/catalog","time":"15:13"}]	2026-03-28 15:13:56	2026-03-28 15:13:56
118	LEty5Z8eNzQsEwvZKw0PpxZfNk8OTfDrXHAoVYGN	103.136.220.230	2026-03-29	[{"path":"\\/","time":"00:32"}]	2026-03-29 00:32:46	2026-03-29 00:32:46
120	aFjmVdVQjlTxUazoo0yhvJ63hONi5yU9r2ZKABRQ	103.136.221.232	2026-03-29	[{"path":"\\/","time":"00:32"}]	2026-03-29 00:32:59	2026-03-29 00:32:59
122	zEvBxgsCHON6Jv93uyUVm28lCpNMq8VLZAQw3Rgi	66.249.74.33	2026-03-30	[{"path":"\\/","time":"05:49"}]	2026-03-30 05:49:06	2026-03-30 05:49:07
124	eCCNhRvTDuKvV13ixFB8cuZPfJ9TQAgu2KRpj1gP	66.249.74.36	2026-03-30	[{"path":"\\/","time":"15:49"}]	2026-03-30 15:49:34	2026-03-30 15:49:34
126	LatcrfbVR2QwRUK6OMPX9RqNldlUrIbpLiHikXIm	40.77.178.240	2026-03-30	[{"path":"\\/","time":"18:06"}]	2026-03-30 18:06:10	2026-03-30 18:06:10
128	gtAGxOOLPSo4ATRtVNrnL12q7T1rfq85rRx4ccOT	66.249.74.36	2026-03-31	[{"path":"\\/","time":"02:05"}]	2026-03-31 02:05:18	2026-03-31 02:05:18
130	3EvAysLmSb06mCVSZnevBqEB2Wy1O2vizTEdvAc6	17.22.253.208	2026-03-31	[{"path":"\\/domain-registration","time":"08:08"}]	2026-03-31 08:08:04	2026-03-31 08:08:05
132	oeCeFbc0y1DofF4xbv0KQFedTGJA6NzGPzgWTlf7	66.249.73.6	2026-03-31	[{"path":"\\/refund-policy","time":"18:39"}]	2026-03-31 18:39:43	2026-03-31 18:39:44
134	XsBnox8MFcm1dL7fhx7Tz8ql9ZwIgWku9jO0s8YJ	17.22.245.104	2026-03-31	[{"path":"\\/domain-registration","time":"21:35"}]	2026-03-31 21:35:07	2026-03-31 21:35:08
136	w1DxwiASW6ZZsPsDQ9ivCGQf71s3c2jtZ6kZWv1c	103.130.131.99	2026-04-02	[{"path":"\\/","time":"04:00"}]	2026-04-02 04:00:59	2026-04-02 04:00:59
138	G1btgpn2lkptNBu3bSZN0sHVRZdnne3kcHkb7BEN	66.249.73.6	2026-04-02	[{"path":"\\/","time":"09:49"}]	2026-04-02 09:49:55	2026-04-02 09:49:55
140	4bWDk9kec9u6TsdjddiEcUgYTyBW8qwZ7AJpeBjs	202.8.42.182	2026-04-03	[{"path":"\\/","time":"06:30"}]	2026-04-03 06:30:40	2026-04-03 06:30:42
142	AG9ZEfnem1SykNd4aeTQgTWKvpQWOxD60Rcw2vmG	17.22.253.101	2026-04-03	[{"path":"\\/domain-registration","time":"22:48"}]	2026-04-03 22:48:51	2026-04-03 22:48:52
144	5zMJyY4MI9g8mE8Ap6t0G9i5CiavmFdY8FTSmHcu	182.253.228.96	2026-04-04	[{"path":"\\/","time":"04:32"}]	2026-04-04 04:32:41	2026-04-04 04:32:43
146	JbWCQHp6fidO8eeKYYK1tAvKhoEZ6Kk2S9kOccdD	66.249.65.38	2026-04-04	[{"path":"\\/refund-policy","time":"10:02"}]	2026-04-04 10:01:57	2026-04-04 10:02:00
148	TbPz0mjub8mEASflfrJ4yKEjRaK2pt67EHKdlyNB	66.249.73.192	2026-04-04	[{"path":"\\/","time":"22:00"}]	2026-04-04 22:00:40	2026-04-04 22:00:40
150	AvGnvGgsGYQ15p4jbT8F5mnivcc7U5qixwJUoMgV	52.167.144.237	2026-04-06	[{"path":"\\/about-us","time":"16:14"}]	2026-04-06 16:14:29	2026-04-06 16:14:29
152	yoWwpai734CGLaG10aB7lW3PLXFvQDWmQaibmzI1	17.241.75.212	2026-04-07	[{"path":"\\/terms","time":"03:58"}]	2026-04-07 03:58:19	2026-04-07 03:58:19
154	VlWzQz8DIKHCI2qM6ATf6VQvJda1C1NyL1s8o7wn	66.249.71.129	2026-04-08	[{"path":"\\/about-us","time":"05:08"}]	2026-04-08 05:08:20	2026-04-08 05:08:20
156	xOzZN5fmAMfWLwNobugImoP40GnHxKgWEXTKogOD	66.249.65.37	2026-04-08	[{"path":"\\/order\\/domain","time":"11:50"}]	2026-04-08 11:50:00	2026-04-08 11:50:01
158	sDNH3KNb9VvgaoVOEfuzVHynCGSG6n7TaJ2WndJn	64.71.166.35	2026-04-08	[{"path":"\\/","time":"12:52"}]	2026-04-08 12:52:08	2026-04-08 12:52:08
160	S2XwX7H5jXKyF9bBanIIQVeyiLd6rL5iWy3TyNu1	66.249.73.194	2026-04-08	[{"path":"\\/","time":"15:35"}]	2026-04-08 15:35:07	2026-04-08 15:35:08
162	UAabuADYgfQizjKr2wH8U9RBciPEJlxdN4Zd8sdP	17.241.227.199	2026-04-09	[{"path":"\\/domain-registration","time":"09:15"}]	2026-04-09 09:15:39	2026-04-09 09:15:39
164	06E90IkvioS54lky3xTed7T7nyjEMvKR3QvFuxBR	40.77.167.235	2026-04-09	[{"path":"\\/","time":"18:30"}]	2026-04-09 18:30:09	2026-04-09 18:30:11
166	fYAqBtDtlOg4oln8D9BxqEjPekOKKja5QkEEF5n6	66.249.73.196	2026-04-10	[{"path":"\\/","time":"03:21"}]	2026-04-10 03:20:59	2026-04-10 03:21:00
168	v7SlP70UW5wym0m4zWE350dtiZG3ccvGAa5utW4k	40.77.167.63	2026-04-10	[{"path":"\\/","time":"11:16"}]	2026-04-10 11:16:56	2026-04-10 11:16:56
170	yHf4mU5xSb8uvT1BXgcpqQwLveQgkKlepVs34Mnq	182.253.150.3	2026-04-11	[{"path":"\\/","time":"13:08"}]	2026-04-11 13:08:17	2026-04-11 13:08:17
172	0fh9xb8RjgoTMZUoDLsP2Y0InI9onuYUPIDTAaTp	66.249.73.193	2026-04-11	[{"path":"\\/","time":"17:47"}]	2026-04-11 17:47:32	2026-04-11 17:47:32
173	4JsYMPtaooorLo2FrTvRbkrLr5QLdgd2wKlJDe5G	149.56.150.234	2026-04-12	[{"path":"\\/","time":"07:55"}]	2026-04-12 07:55:56	2026-04-12 07:55:57
174	GehQRRm99qLyZrahnOM8k8DzIUrzEKeOc2a1aCGo	17.22.253.9	2026-04-12	[{"path":"\\/domain-registration","time":"13:22"}]	2026-04-12 13:22:28	2026-04-12 13:22:28
175	o1CQtcEgIEB81dsQ69YOVhIfUhwAsUKQg1oWREBi	124.40.249.137	2026-04-13	[{"path":"\\/","time":"23:45"}]	2026-04-13 23:45:05	2026-04-13 23:45:06
176	1PJxGY9bYb1C421hpBlcUwxrr0cGryAPnMQNspVN	124.40.249.137	2026-04-13	[{"path":"\\/","time":"23:45"}]	2026-04-13 23:45:11	2026-04-13 23:45:12
177	RSX32TSPrBMi6Cgyo0kH9lfDkA5LN2nuKSCRJ531	182.4.102.229	2026-04-13	[{"path":"\\/","time":"23:45"}]	2026-04-13 23:45:31	2026-04-13 23:45:31
178	dDdVv2kpy0w7WH6xxgoqwTEz6h79aALUuV0z7ilS	182.253.150.7	2026-04-14	[{"path":"\\/","time":"08:35"}]	2026-04-14 08:35:25	2026-04-14 08:35:26
179	PPM96KgiokdKQNFwAOBIl9eDnm1A03jWUoPld9YG	112.215.140.163	2026-04-15	[{"path":"\\/","time":"04:47"},{"path":"\\/faq","time":"04:48"},{"path":"\\/portfolio","time":"04:48"}]	2026-04-15 04:47:24	2026-04-15 04:48:46
180	KX4Cho2BbVtEbI0pTtranvtD3uDwzawiqfcdXTF1	66.249.71.129	2026-04-15	[{"path":"\\/saas-marketplace","time":"05:58"}]	2026-04-15 05:58:19	2026-04-15 05:58:19
181	IKG5eMSuo1BBdLg11aRZ3pBEFffZIcUYV0NIWcj8	66.249.73.193	2026-04-15	[{"path":"\\/saas\\/fast-vpn","time":"06:33"}]	2026-04-15 06:33:32	2026-04-15 06:33:32
182	RujXHlfSjkAAH2uKnB43xOyiUMblF0qzZZfwT5Hs	17.246.19.12	2026-04-15	[{"path":"\\/domain-registration","time":"08:23"}]	2026-04-15 08:23:48	2026-04-15 08:23:48
50	1QdncfcpJrGoz5mKYI8AMdoCROSTw0S2jTbHT1mg	66.249.73.235	2026-03-16	[{"path":"\\/refund-policy","time":"20:27"}]	2026-03-16 20:27:40	2026-03-16 20:27:40
51	xOXXMP1lHQB6pu8kXol4tervlQSqthPy4QDGOoWz	66.249.73.234	2026-03-17	[{"path":"\\/services","time":"03:06"}]	2026-03-17 03:06:42	2026-03-17 03:06:42
53	HuRIXbapW7buVNGu72WpIfeqtTL6NkKYuvFRL45Z	173.239.217.151	2026-03-17	[{"path":"\\/","time":"08:42"}]	2026-03-17 08:42:04	2026-03-17 08:42:05
44	Xxx1BJpCpsilYU7d0IrqJodDO68FsnXGMsCP91iT	182.2.191.116	2026-03-16	[{"path":"\\/","time":"05:40"},{"path":"\\/catalog","time":"05:40"},{"path":"\\/services","time":"05:41"},{"path":"\\/about-us","time":"05:41"},{"path":"\\/services","time":"05:49"},{"path":"\\/","time":"05:50"},{"path":"\\/domain-registration","time":"06:12"},{"path":"\\/order\\/domain","time":"06:16"},{"path":"\\/cart","time":"06:18"},{"path":"\\/checkout","time":"06:19"},{"path":"\\/order\\/instruction\\/7","time":"06:20"},{"path":"\\/domain-registration","time":"06:21"},{"path":"\\/order\\/domain","time":"06:33"},{"path":"\\/cart","time":"06:37"},{"path":"\\/checkout","time":"06:39"},{"path":"\\/cart","time":"06:42"},{"path":"\\/checkout","time":"06:45"},{"path":"\\/order\\/instruction\\/8","time":"06:45"},{"path":"\\/cart","time":"06:47"},{"path":"\\/profile","time":"06:47"},{"path":"\\/catalog","time":"06:47"},{"path":"\\/","time":"06:50"},{"path":"\\/vps-hosting","time":"06:52"},{"path":"\\/","time":"06:54"},{"path":"\\/vps-hosting","time":"06:58"},{"path":"\\/order\\/vps","time":"07:01"},{"path":"\\/cart","time":"07:06"},{"path":"\\/checkout","time":"07:11"},{"path":"\\/order\\/instruction\\/9","time":"07:12"},{"path":"\\/","time":"07:21"},{"path":"\\/cpanel-hosting","time":"07:26"},{"path":"\\/order\\/cpanel","time":"07:29"},{"path":"\\/cart","time":"07:35"},{"path":"\\/checkout","time":"07:36"},{"path":"\\/order\\/instruction\\/10","time":"07:38"},{"path":"\\/catalog","time":"07:40"},{"path":"\\/","time":"07:40"},{"path":"\\/saas-marketplace","time":"07:41"},{"path":"\\/saas\\/fast-vpn","time":"07:48"},{"path":"\\/saas-marketplace","time":"07:48"},{"path":"\\/saas\\/business-email","time":"07:50"},{"path":"\\/saas-marketplace","time":"07:53"},{"path":"\\/saas\\/ssl-certificates","time":"07:53"},{"path":"\\/saas\\/business-email","time":"07:55"},{"path":"\\/order\\/saas","time":"07:59"},{"path":"\\/cart","time":"08:07"},{"path":"\\/checkout","time":"08:10"},{"path":"\\/order\\/instruction\\/11","time":"08:10"},{"path":"\\/","time":"08:16"},{"path":"\\/catalog","time":"08:17"},{"path":"\\/","time":"08:17"},{"path":"\\/about-us","time":"08:30"},{"path":"\\/contact","time":"08:40"},{"path":"\\/join-partner","time":"08:57"},{"path":"\\/","time":"08:58"},{"path":"\\/client-area","time":"08:59"},{"path":"\\/join-partner","time":"08:59"},{"path":"\\/partner-verification","time":"09:03"},{"path":"\\/","time":"09:05"},{"path":"\\/partner-verification","time":"09:05"},{"path":"\\/client-area","time":"09:14"},{"path":"\\/client-area\\/hosting","time":"09:18"},{"path":"\\/client-area","time":"09:21"}]	2026-03-16 05:40:25	2026-03-16 09:21:56
46	xg5zo0iYVUPuPa6mdPARFYSWXwxxxGKN3mVMgxty	182.253.228.97	2026-03-16	[{"path":"\\/","time":"12:40"}]	2026-03-16 12:40:17	2026-03-16 12:40:18
47	g45JrH2QxTsBFrLLfqGiQH7T7OptaSrQNs2hJXA7	40.77.167.158	2026-03-16	[{"path":"\\/","time":"13:39"}]	2026-03-16 13:39:35	2026-03-16 13:39:35
48	BP69Gb6GkY03u6bBfRkqE9psQ1DPT6MII41B2qVB	66.249.71.128	2026-03-16	[{"path":"\\/","time":"18:33"}]	2026-03-16 18:33:58	2026-03-16 18:33:58
49	ATiDRz8iXP0mHou9asNlDVIjd7eGeifz897ZlivI	66.249.71.128	2026-03-16	[{"path":"\\/","time":"18:34"}]	2026-03-16 18:34:02	2026-03-16 18:34:02
54	IJVkrBOP8pkO5gffKobxKRbPKWlE3espLHfYJKSD	66.249.73.5	2026-03-17	[{"path":"\\/","time":"09:00"}]	2026-03-17 09:00:50	2026-03-17 09:00:50
52	5UJcu1DMx7Z7e0btLpykf39GAUscwgQgy9yK47Lg	182.253.150.3	2026-03-17	[{"path":"\\/","time":"08:31"},{"path":"\\/login","time":"10:14"}]	2026-03-17 08:31:10	2026-03-17 10:14:43
55	qtTBEAuRuKCGXLAimvdAblMQWTGnSX61pIlsxSRc	66.249.73.235	2026-03-17	[{"path":"\\/order\\/domain","time":"10:36"}]	2026-03-17 10:36:41	2026-03-17 10:36:41
56	p5r57fxMNPjWjV7ZPxcveU7xmHVDk8kOf95iEXR9	220.200.229.170	2026-03-17	[{"path":"\\/","time":"11:39"}]	2026-03-17 11:39:50	2026-03-17 11:39:50
57	FBcSMC3ct4ctZc3EKNyIEz5pwVrHqp3dbtJCOEZC	220.200.229.170	2026-03-17	[{"path":"\\/","time":"11:39"}]	2026-03-17 11:39:53	2026-03-17 11:39:53
58	LmWDtRqHKq21ddtrRlSf2WZXtNodfCTrkCoSyVTB	220.200.229.170	2026-03-17	[{"path":"\\/","time":"11:39"}]	2026-03-17 11:39:54	2026-03-17 11:39:54
70	gEGp5oaLc2T7BbqwTDcRp6bnnvVmj6YJkDgeICHm	66.249.65.101	2026-03-18	[{"path":"\\/","time":"13:16"}]	2026-03-18 13:16:09	2026-03-18 13:16:10
60	ZbDatPj4NOuwFIcHz7QX1rY11bYMv6NZMM4aPaVV	66.249.73.235	2026-03-17	[{"path":"\\/about-us","time":"13:24"}]	2026-03-17 13:24:52	2026-03-17 13:24:52
61	SwX26MKILyJoYvnbwfyPOrJibYGiHtrABu01hTft	182.253.127.201	2026-03-17	[{"path":"\\/about-us","time":"14:57"}]	2026-03-17 14:57:18	2026-03-17 14:57:18
62	GAveUD2MdRQToazGeuZjvFBIcsblOmMeh7FerTHj	66.249.65.101	2026-03-17	[{"path":"\\/","time":"15:25"}]	2026-03-17 15:25:35	2026-03-17 15:25:35
59	CYVfdcx5Ig4XkiXPyNDftJTeqTxmAbBFBTpBme9p	66.249.73.235	2026-03-17	[{"path":"\\/vps-hosting","time":"13:06"},{"path":"\\/","time":"17:03"}]	2026-03-17 13:06:42	2026-03-17 17:03:56
63	U9kQYqNu8KLfEibrpwXAs832fZv6STLU8r0YIulI	66.249.73.234	2026-03-17	[{"path":"\\/login","time":"17:55"}]	2026-03-17 17:55:33	2026-03-17 17:55:33
64	xoHTUFFqhOQE8bNlVJqA4RumGnqahlQFJExeM5CQ	103.100.175.153	2026-03-18	[{"path":"\\/","time":"06:11"}]	2026-03-18 06:11:45	2026-03-18 06:11:45
65	XSjeVdzcSLJzFPYMqRzgOO6WJkvThwRPdNaPFzcq	114.10.156.22	2026-03-18	[{"path":"\\/","time":"11:00"}]	2026-03-18 11:00:41	2026-03-18 11:00:42
66	fM5u0ntM2fqG0e43mtuSkX102TquXTH53iRNfmvx	182.253.228.97	2026-03-18	[{"path":"\\/","time":"11:01"}]	2026-03-18 11:01:05	2026-03-18 11:01:05
67	f8yiEFjhVq4uJqEQwfPFLgaofDv91sOlsA1w3Kr2	182.253.228.97	2026-03-18	[{"path":"\\/","time":"11:59"}]	2026-03-18 11:59:51	2026-03-18 11:59:52
77	WqKqPCPbOOoBFRcfFwGTxReWMhue3fBCQDCamD73	52.167.144.238	2026-03-19	[{"path":"\\/about-us","time":"14:06"}]	2026-03-19 14:06:18	2026-03-19 14:06:18
69	N94R14Qgg1PVkennxfgHI8BducT2pjpcOnsbl7lU	182.253.228.97	2026-03-18	[{"path":"\\/","time":"12:03"}]	2026-03-18 12:03:39	2026-03-18 12:03:39
68	TrsHHKZne16qEpi1dCLG2cpNCrNQKt5dYv6cUybv	182.253.228.97	2026-03-18	[{"path":"\\/","time":"12:02"},{"path":"\\/domain-registration","time":"12:03"},{"path":"\\/","time":"12:09"}]	2026-03-18 12:02:27	2026-03-18 12:09:42
78	hDO5zTmNmjHFUlIqUJIkX3nwPydDTBiUnhZbICJA	66.249.73.193	2026-03-20	[{"path":"\\/","time":"03:26"}]	2026-03-20 03:26:13	2026-03-20 03:26:13
71	cgLwXWPb6lowwEGq3CIZkDYDBtFqMxr1ZYBK8qQx	180.242.129.156	2026-03-18	[{"path":"\\/","time":"18:57"},{"path":"\\/about-us","time":"18:58"},{"path":"\\/contact","time":"18:58"},{"path":"\\/services","time":"18:58"}]	2026-03-18 18:57:59	2026-03-18 18:58:58
72	EDyvz3rJRnU4z0q3dzDrLXHLguloe0cRI88Wl2IN	175.44.42.251	2026-03-19	[{"path":"\\/","time":"00:37"}]	2026-03-19 00:37:41	2026-03-19 00:37:41
73	rAg2Uk7mTwpPJjsYODMGVszhbvUTZnd8y1dhsXx0	17.241.219.52	2026-03-19	[{"path":"\\/faq","time":"03:06"}]	2026-03-19 03:06:03	2026-03-19 03:06:03
74	c9M99RjYFRtfSKQH6IIQ1Ck3j5NQk95vtA2dMnkE	182.10.161.183	2026-03-19	[{"path":"\\/","time":"08:55"},{"path":"\\/catalog","time":"08:56"}]	2026-03-19 08:55:25	2026-03-19 08:56:00
75	JqJxuOMkLAYMyoR9ET57lkFPsr7J0PCPY8dbFb12	66.249.74.163	2026-03-19	[{"path":"\\/","time":"11:56"}]	2026-03-19 11:56:19	2026-03-19 11:56:19
76	kOnVT83VH7Hd55USfQa9zCUJvDDC5NDjWcH54Pxz	66.249.65.102	2026-03-19	[{"path":"\\/","time":"13:11"}]	2026-03-19 13:11:28	2026-03-19 13:11:28
79	XROKSQrQNKS3NpUp2EOdtHE9JCGcmD7Ej1vycuL0	40.77.167.53	2026-03-20	[{"path":"\\/login","time":"07:05"}]	2026-03-20 07:05:19	2026-03-20 07:05:19
80	sCVfRBi645dzqk5AXkQcMiPbGWwE8VWoGtjlgihf	182.253.150.6	2026-03-20	[{"path":"\\/","time":"10:52"}]	2026-03-20 10:52:22	2026-03-20 10:52:22
81	ScVvEL71K3dEXrhV8epb2gGPA1P8pGC6ZDbHnEo8	66.249.73.192	2026-03-21	[{"path":"\\/services","time":"04:05"}]	2026-03-21 04:05:54	2026-03-21 04:05:55
82	rLxPY7rtwskMRFtg6oszfzTxgTJ6zcxeJL6zBlsU	66.249.73.4	2026-03-21	[{"path":"\\/","time":"04:56"}]	2026-03-21 04:56:50	2026-03-21 04:56:50
83	7kGpjvPaYgMq5jhHCdKU1J3pAGijDKcvyXdt4csq	66.249.73.234	2026-03-21	[{"path":"\\/services","time":"06:54"}]	2026-03-21 06:54:48	2026-03-21 06:54:48
84	q5zer7kaNCDHGw45x2LDIb3Crs9hCm5bYM8aATcB	66.249.73.235	2026-03-21	[{"path":"\\/domain-registration","time":"09:34"}]	2026-03-21 09:34:16	2026-03-21 09:34:16
85	gaenmWBuwXl7EhLbNeIfrqpfE4tEePkRuSd5oo0Z	66.249.65.102	2026-03-21	[{"path":"\\/","time":"10:49"}]	2026-03-21 10:49:12	2026-03-21 10:49:13
86	BFSEvPB4iVXTE1iLbPB3bPYZIO1PXDi8HaEHpsxx	66.249.65.102	2026-03-21	[{"path":"\\/services","time":"21:27"}]	2026-03-21 21:27:30	2026-03-21 21:27:31
87	oavmLgNDD3DMnyiqYjKn8cSDsflAcA4dxyb4KO5i	40.77.167.16	2026-03-21	[{"path":"\\/","time":"21:55"}]	2026-03-21 21:55:34	2026-03-21 21:55:35
88	9kq6jmKxqx0zJnIkTIkty6a075sJ1n10CviNPY1U	114.10.156.89	2026-03-22	[{"path":"\\/","time":"12:51"},{"path":"\\/vps-hosting","time":"12:51"},{"path":"\\/order\\/vps","time":"12:51"}]	2026-03-22 12:51:21	2026-03-22 12:51:54
89	4GvuZncmWBxJ3ffM7cN7C7d1RdELOV95fulQYyvV	176.125.228.25	2026-03-22	[{"path":"\\/","time":"23:46"}]	2026-03-22 23:46:34	2026-03-22 23:46:34
90	Cl9T3IQ13J7oxtYNgirRkaFlEWPRilmxwkhVHezO	52.167.144.191	2026-03-23	[{"path":"\\/vps-hosting","time":"00:23"}]	2026-03-23 00:23:17	2026-03-23 00:23:17
183	ZL8ANNpLspIBs3ifZkxAS2BhE0whReIxLtUmPbE1	66.249.65.38	2026-04-15	[{"path":"\\/order\\/domain","time":"10:06"}]	2026-04-15 10:06:17	2026-04-15 10:06:17
184	4UIeb1L8IDSPmjsbWGyVPJJZosv9vOStHAjRVBWm	17.246.23.69	2026-04-15	[{"path":"\\/portfolio","time":"20:37"}]	2026-04-15 20:37:32	2026-04-15 20:37:32
185	bfPq7dOPEBnA5pWp7bKeNxfbp4afuqM0UZ1JDCuf	66.249.65.38	2026-04-15	[{"path":"\\/","time":"23:54"}]	2026-04-15 23:54:24	2026-04-15 23:54:24
186	YOFfIZNnMaVJ9I5znXqBL0k6pkaK8C5msZ2XhZUH	66.249.73.192	2026-04-17	[{"path":"\\/","time":"13:48"}]	2026-04-17 13:48:28	2026-04-17 13:48:28
187	PFnEevLcoQxx7uVE7BLnuqzwie3IabxDl21mgye9	66.249.64.163	2026-04-17	[{"path":"\\/","time":"15:08"}]	2026-04-17 15:08:33	2026-04-17 15:08:33
188	pEflyT1kJyU2ql7DbmUZUYJpRVdWxnxcQZ5D6kWb	182.253.150.2	2026-04-18	[{"path":"\\/","time":"03:30"}]	2026-04-18 03:30:41	2026-04-18 03:30:41
189	JpEMRhmezjqXqiaRmFKIxJ3CkA1KwhIMQIWVmlc4	17.246.15.68	2026-04-18	[{"path":"\\/faq","time":"14:13"}]	2026-04-18 14:13:47	2026-04-18 14:13:47
190	QD6D2AUo2eYYWrXmo3rf2LxTmA36LjT82tShFRCw	157.55.39.53	2026-04-18	[{"path":"\\/about-us","time":"16:57"}]	2026-04-18 16:57:49	2026-04-18 16:57:49
191	u5rWFCxhyLgthFnp8Ulu6M4dKoh7qmnmTK79H8bn	17.22.253.32	2026-04-19	[{"path":"\\/refund-policy","time":"08:04"}]	2026-04-19 08:04:45	2026-04-19 08:04:46
192	DmqB7GkKX9StWNfgkXUFhN5Gelz4czVraHpHzpez	17.246.23.191	2026-04-19	[{"path":"\\/terms","time":"09:43"}]	2026-04-19 09:43:29	2026-04-19 09:43:29
193	RbMZdAIC7GZSwURTwhWNauwhlUwsyYQlv05zjiAo	54.236.30.163	2026-04-19	[{"path":"\\/","time":"11:19"}]	2026-04-19 11:19:56	2026-04-19 11:19:56
194	9Y9YYKVQ4x2JAYoLCcYjAAXwbOv1vTLj94u957AH	17.241.219.172	2026-04-19	[{"path":"\\/domain-registration","time":"11:46"}]	2026-04-19 11:46:15	2026-04-19 11:46:15
195	FmRC3GhHd75UbIk2Gtv5uTYh9LPPJ1G2sQdUIkDB	17.22.253.163	2026-04-19	[{"path":"\\/domain-registration","time":"12:15"}]	2026-04-19 12:15:31	2026-04-19 12:15:31
196	s00GdKKyT6wQOEPcxILqoA64OYA9sYBbyEL0pKSy	17.22.253.4	2026-04-19	[{"path":"\\/domain-registration","time":"16:13"}]	2026-04-19 16:13:10	2026-04-19 16:13:10
197	xLLdDS58NFVryAAzXky1yXC6VIvYh86tmiFx7oNW	17.241.227.195	2026-04-19	[{"path":"\\/login","time":"23:34"}]	2026-04-19 23:34:00	2026-04-19 23:34:00
198	x39I0462aEm6kYVLiOVpaHL3htnLykYKmlr4sG25	17.22.237.176	2026-04-20	[{"path":"\\/saas-marketplace","time":"04:52"}]	2026-04-20 04:52:55	2026-04-20 04:52:55
199	QD6D2AUo2eYYWrXmo3rf2LxTmA36LjT82tShFRCw	52.167.144.208	2026-04-20	[{"path":"\\/cpanel-hosting","time":"10:34"}]	2026-04-20 10:34:11	2026-04-20 10:34:12
200	SyFJb2MoFQfhsjll3YIkzkYuoYnMW38iMEYcAnT2	17.241.227.21	2026-04-20	[{"path":"\\/domain-registration","time":"11:25"}]	2026-04-20 11:25:31	2026-04-20 11:25:31
201	qnDeJouxyV7qIj7MgjNqJXMGWOTEP8WOKLXlOIC9	185.253.162.23	2026-04-20	[{"path":"\\/","time":"17:49"}]	2026-04-20 17:49:08	2026-04-20 17:49:08
202	16YAzDLqy3qYW6yis8ldL9pZW5kMaoHB82PVfqrS	66.96.232.97	2026-04-20	[{"path":"\\/about-us","time":"18:01"}]	2026-04-20 18:01:58	2026-04-20 18:01:58
203	17wDdaeaexu7nDv28bFRivXVwdpWSY82gXG7lgfh	17.246.23.30	2026-04-20	[{"path":"\\/domain-registration","time":"23:33"}]	2026-04-20 23:33:35	2026-04-20 23:33:35
204	KnyOtEi4itNcjSq4TsZ9jsJxVKbu1vEEkOBVXFU8	114.5.244.122	2026-04-21	[{"path":"\\/","time":"03:26"}]	2026-04-21 03:26:54	2026-04-21 03:26:54
205	G2a8oZ90fLeyR0sa0l26LNSkJsCria8syBzT1vpH	182.8.228.197	2026-04-21	[{"path":"\\/","time":"04:11"}]	2026-04-21 04:11:07	2026-04-21 04:11:08
206	hFNNnfFgnZ2vCqO38MX5mg44YobvvWiPR2Oearm3	202.65.238.162	2026-04-21	[{"path":"\\/","time":"05:28"},{"path":"\\/domain-registration","time":"05:29"}]	2026-04-21 05:28:41	2026-04-21 05:29:01
207	FAIlZqfB2kzafPW2eTSbpqVlEwcNQt517FrO2Sog	52.167.144.160	2026-04-21	[{"path":"\\/saas-marketplace","time":"09:08"}]	2026-04-21 09:08:54	2026-04-21 09:08:54
208	c9rhXLb1f5CSlUVKuCK1yKxLTz34MA6v8CYsKiPs	140.213.45.148	2026-04-21	[{"path":"\\/domain-registration","time":"15:48"}]	2026-04-21 15:48:13	2026-04-21 15:48:13
209	QD6D2AUo2eYYWrXmo3rf2LxTmA36LjT82tShFRCw	40.77.167.56	2026-04-22	[{"path":"\\/","time":"06:08"}]	2026-04-22 06:08:33	2026-04-22 06:08:34
210	S8OgHNGO156hh59hmou1zrsNlFcYDTf8xHhBCDuU	182.253.150.7	2026-04-22	[{"path":"\\/","time":"07:33"}]	2026-04-22 07:33:48	2026-04-22 07:33:48
211	EPy9TAF6ZPXJEGsVHO7LYPKOBYbjTmDpCOZGgPuz	17.22.253.98	2026-04-23	[{"path":"\\/domain-registration","time":"02:09"}]	2026-04-23 02:09:49	2026-04-23 02:09:50
212	zzQpqrGzoKF4AuHZp5PVtWg5mSo9N75e6S1dXlu2	17.22.253.88	2026-04-23	[{"path":"\\/faq","time":"16:56"}]	2026-04-23 16:56:54	2026-04-23 16:56:55
213	3OgzNwMw7tZDeBSUSs5mN56a3BptSBZJUoolvyCJ	17.241.75.227	2026-04-23	[{"path":"\\/domain-registration","time":"21:50"}]	2026-04-23 21:50:03	2026-04-23 21:50:04
214	JCBNIcYCrnJiPQ0LVjFEw1LjEg02fGQMllsUwLHf	76.13.20.59	2026-04-24	[{"path":"\\/","time":"03:00"}]	2026-04-24 03:00:19	2026-04-24 03:00:20
215	SEEriwBqGuRBd9G8ecxfLzHwxxc05CmzOenePjAx	66.249.65.37	2026-04-24	[{"path":"\\/","time":"13:43"}]	2026-04-24 13:43:06	2026-04-24 13:43:06
216	AQvTFJcgTIYLOwCXaaUt7MytqbKN76aHbsJjsTnc	66.249.65.37	2026-04-24	[{"path":"\\/","time":"13:43"}]	2026-04-24 13:43:09	2026-04-24 13:43:09
217	iwVmoRXF5DBHnYnTiKhhgKuYBK6kYlO8OwnI7VZ3	182.8.228.78	2026-04-25	[{"path":"\\/","time":"13:02"}]	2026-04-25 13:02:38	2026-04-25 13:02:38
218	pECb9aPS4vJFmLlDNZgZQ3O6KfjY7akEeEw71Zpk	17.241.75.248	2026-04-25	[{"path":"\\/domain-registration","time":"19:13"}]	2026-04-25 19:13:32	2026-04-25 19:13:32
219	tcgLtenfANlGiV1gJFlkYvYdeP7KJRDhm0nHB3GY	17.241.219.185	2026-04-26	[{"path":"\\/domain-registration","time":"04:48"}]	2026-04-26 04:48:35	2026-04-26 04:48:35
220	jOk5P2JjPPsVuQ8qYWWKlDSAEgyldjuCqtet8ADL	17.246.15.56	2026-04-26	[{"path":"\\/domain-registration","time":"05:53"}]	2026-04-26 05:53:25	2026-04-26 05:53:25
221	S6Kw8gGu8nOHlvfglnWTNcqsSVDucvNB9LgfNzx0	17.22.237.84	2026-04-26	[{"path":"\\/terms","time":"06:41"}]	2026-04-26 06:41:41	2026-04-26 06:41:42
222	jUufCrVWDJXIh5fhrGTt1L8hiRmIZFxi3Eylxa66	173.252.82.3	2026-04-26	[{"path":"\\/","time":"10:58"}]	2026-04-26 10:58:34	2026-04-26 10:58:34
223	eNu5dXEVSLxesSd9gT87uJprFKNaZKrQZA9lhV3J	66.220.149.40	2026-04-26	[{"path":"\\/","time":"10:58"}]	2026-04-26 10:58:39	2026-04-26 10:58:39
224	dFnwzDngxCzY7MfgQ0QyhHmDeYN5yZjo1LhpnNkr	65.55.210.44	2026-04-26	[{"path":"\\/about-us","time":"17:35"}]	2026-04-26 17:35:59	2026-04-26 17:35:59
225	PyHTnwC2OynIF31IERfy51TCTYb8wMVfbsHk9Qvf	66.249.73.193	2026-04-27	[{"path":"\\/","time":"01:45"}]	2026-04-27 01:45:35	2026-04-27 01:45:35
226	uobEoXwI2rShPaihdCX4Y26lYzyEp4ejj1pqrju8	17.246.15.195	2026-04-27	[{"path":"\\/domain-registration","time":"14:56"}]	2026-04-27 14:56:13	2026-04-27 14:56:13
227	xebXS4adqh0pUmaGQ8UMsm1iV5XfvIPmf5eS3Jz2	17.22.253.74	2026-04-27	[{"path":"\\/domain-registration","time":"15:59"}]	2026-04-27 15:59:39	2026-04-27 15:59:39
228	kzaiTRmB77K8TiTMjF1QEZoymn50ce0Spx5Vguok	17.246.23.170	2026-04-27	[{"path":"\\/refund-policy","time":"20:14"}]	2026-04-27 20:14:50	2026-04-27 20:14:50
229	2apQ6W8ITjQbpisuMhkT5QQKD8ip1vASUIcjbgpG	17.246.23.55	2026-04-27	[{"path":"\\/domain-registration","time":"20:28"}]	2026-04-27 20:28:30	2026-04-27 20:28:30
230	1Ctsv2VKR9l4LJwSWuyP4m8RrZlhwwKDxmS6RJ8v	175.103.46.186	2026-04-28	[{"path":"\\/","time":"09:34"},{"path":"\\/about-us","time":"09:34"},{"path":"\\/contact","time":"09:34"},{"path":"\\/services","time":"09:34"}]	2026-04-28 09:34:13	2026-04-28 09:34:24
231	FwcBow6VJZUI2tuwBrRtDFQuBhcYkOgMxLehw3tR	17.246.19.49	2026-04-28	[{"path":"\\/domain-registration","time":"20:27"}]	2026-04-28 20:27:15	2026-04-28 20:27:15
255	rDYtSry1Xf9OCCyLZlh1yuBP3m3mtru5egLB37o5	202.8.41.126	2026-05-05	[{"path":"\\/","time":"12:41"}]	2026-05-05 12:41:52	2026-05-05 12:41:52
256	AEIYlw5vx3RBdz1fLFpo8EWdvZHNUPk39gDXjFjd	66.249.66.204	2026-05-05	[{"path":"\\/","time":"18:47"}]	2026-05-05 18:47:56	2026-05-05 18:47:56
232	S7bUsT15CsIt3kzR2A1ADayaoHa4PAV5Tp9S8035	36.78.124.254	2026-04-29	[{"path":"\\/","time":"00:44"},{"path":"\\/about-us","time":"00:44"},{"path":"\\/contact","time":"00:44"},{"path":"\\/services","time":"00:44"}]	2026-04-29 00:44:22	2026-04-29 00:44:31
233	80jF3eiHFCmuJbrr0CzuKHSF5ClSRD6FKJWu2HVM	17.241.227.111	2026-04-29	[{"path":"\\/domain-registration","time":"02:17"}]	2026-04-29 02:17:19	2026-04-29 02:17:19
234	GAN5ufG6XQh6jjYjZmp6PRcEJ11ns3dOTzLK0RqA	17.241.75.55	2026-04-29	[{"path":"\\/domain-registration","time":"07:59"}]	2026-04-29 07:59:57	2026-04-29 07:59:57
235	dFnwzDngxCzY7MfgQ0QyhHmDeYN5yZjo1LhpnNkr	40.77.167.156	2026-04-29	[{"path":"\\/","time":"13:44"}]	2026-04-29 13:44:51	2026-04-29 13:44:51
236	GnVrNj6xyjYifUVnLmRKAUfBqOmRifCAXbqCOm3Y	103.141.61.140	2026-04-30	[{"path":"\\/","time":"04:09"}]	2026-04-30 04:09:36	2026-04-30 04:09:36
237	8SRzHwm3dRvGnJhYRJhEL3WyGUylN2HpHEKGgdNu	17.241.219.35	2026-04-30	[{"path":"\\/domain-registration","time":"07:16"}]	2026-04-30 07:16:57	2026-04-30 07:16:57
238	clDSejwt44fxTKWWqSgeiVEGtOd2h94EBJ8R1GY0	66.249.73.196	2026-04-30	[{"path":"\\/","time":"13:43"}]	2026-04-30 13:43:15	2026-04-30 13:43:15
239	vc3T4ovMWCN0Ozo1Pd4kAONIvhlmQAD6HooUAdbP	205.206.79.239	2026-04-30	[{"path":"\\/register","time":"22:50"}]	2026-04-30 22:50:20	2026-04-30 22:50:20
240	65xs79Y2NTAtltJCn2pV8gITjD19ftCPs1d9Qgjz	182.8.228.78	2026-05-01	[{"path":"\\/","time":"03:10"}]	2026-05-01 03:10:52	2026-05-01 03:10:52
241	JKhkYllpcu2xemAjHvCySuk0NMvSipwR3g4uDx0i	52.167.144.210	2026-05-01	[{"path":"\\/services","time":"08:11"}]	2026-05-01 08:11:47	2026-05-01 08:11:47
242	Lqzb8oOpIKhkEtTL0pgOhGFNQNuxW4ryS67vNs0i	182.8.228.100	2026-05-01	[{"path":"\\/about-us","time":"08:40"},{"path":"\\/contact","time":"08:40"}]	2026-05-01 08:40:33	2026-05-01 08:40:45
243	fxL3EMIHp8NGtBmZWXzvntyOj4K4PTNm1oqQBDio	66.249.66.192	2026-05-01	[{"path":"\\/about-us","time":"19:01"}]	2026-05-01 19:01:16	2026-05-01 19:01:16
244	ScXigMbWl56KuYSMhWoXLegZbO48HbnmiBATQjgL	182.8.228.84	2026-05-02	[{"path":"\\/","time":"06:12"}]	2026-05-02 06:12:37	2026-05-02 06:12:37
245	RyZF9FKTxdRwBR8NNkuOSRIskRxFJSwckh76tjli	66.249.66.32	2026-05-02	[{"path":"\\/","time":"07:30"}]	2026-05-02 07:30:25	2026-05-02 07:30:25
246	meWwvXh06FSI9SxGb23q2rjN94XZ9C11si0CssCW	52.167.144.19	2026-05-02	[{"path":"\\/about-us","time":"12:18"}]	2026-05-02 12:18:31	2026-05-02 12:18:31
247	gjnrBtul2rsixS1KInjJSg4rUZqP5O3HNzOHFZYf	66.249.66.192	2026-05-02	[{"path":"\\/register","time":"12:55"}]	2026-05-02 12:55:12	2026-05-02 12:55:13
248	yB8C3tiv00CGIZUrVLWyAB2PyS5yTpMfuxp4VE3i	17.246.15.41	2026-05-03	[{"path":"\\/domain-registration","time":"08:23"}]	2026-05-03 08:23:22	2026-05-03 08:23:22
249	KF5Twp5VtGtVsH0POz1PhJoMnPfDqi36xSejX1Il	17.246.19.203	2026-05-03	[{"path":"\\/domain-registration","time":"10:47"}]	2026-05-03 10:47:05	2026-05-03 10:47:05
250	4X5oTQClyTC3o3v3nEborH2savdg6f34gsyP4OFy	114.10.11.45	2026-05-04	[{"path":"\\/","time":"03:30"}]	2026-05-04 03:30:53	2026-05-04 03:30:53
251	MAl4nrPz1GalPD7yICvm9VYzbKTBqAgB54p4AVHk	57.141.20.43	2026-05-04	[{"path":"\\/","time":"04:41"}]	2026-05-04 04:41:40	2026-05-04 04:41:40
252	meWwvXh06FSI9SxGb23q2rjN94XZ9C11si0CssCW	52.167.144.229	2026-05-04	[{"path":"\\/vps-hosting","time":"18:20"}]	2026-05-04 18:20:46	2026-05-04 18:20:46
257	fUZP2ycEWHINhPGEjieUAePwRldGlY41oyVzlBuq	66.249.92.192	2026-05-05	[{"path":"\\/register","time":"19:16"}]	2026-05-05 19:16:29	2026-05-05 19:16:29
253	ueQ0CWUeFR9TOjtlsZqTfOXTWpcetTcYEM5fEy6C	103.118.98.118	2026-05-05	[{"path":"\\/","time":"02:29"},{"path":"\\/saas-marketplace","time":"02:30"}]	2026-05-05 02:29:54	2026-05-05 02:30:26
254	ntjj61yzEgL4tojipeyNE6zaD8ZPnOOqd45IFE4q	66.249.66.42	2026-05-05	[{"path":"\\/vps-hosting","time":"09:38"}]	2026-05-05 09:38:49	2026-05-05 09:38:49
258	fqIIexO8AozitwG3boDtUWZYqhgHTkhN8gzx6Ptp	17.22.237.166	2026-05-06	[{"path":"\\/domain-registration","time":"05:19"}]	2026-05-06 05:19:55	2026-05-06 05:19:55
259	pudWpPhecGqM1ROaBT81KYcjbhyLNnpOLJFYkErq	17.22.253.146	2026-05-07	[{"path":"\\/domain-registration","time":"14:02"}]	2026-05-07 14:02:39	2026-05-07 14:02:39
260	dwCitYIrnC4SreBgq9PSUlFLlzw1Or4UtGJtS3QA	17.22.237.27	2026-05-07	[{"path":"\\/domain-registration","time":"18:57"}]	2026-05-07 18:57:14	2026-05-07 18:57:14
261	Ov9AXjeqLZmPDqDxOiMtfwBdyTapmKDPjo0V1iiC	40.77.167.26	2026-05-07	[{"path":"\\/","time":"23:59"}]	2026-05-07 23:59:23	2026-05-07 23:59:23
262	6mLZcSIE5vzQjuBdEKdq25kAi6t5RzPvTHhHGKvu	182.8.229.98	2026-05-08	[{"path":"\\/","time":"00:51"}]	2026-05-08 00:51:29	2026-05-08 00:51:29
266	76zffeHjQw7Jp0yx2k6NEwqwsX2oyBeCnoCpXB5t	17.22.245.185	2026-05-09	[{"path":"\\/domain-registration","time":"10:03"}]	2026-05-09 10:03:26	2026-05-09 10:03:26
263	D2NKtHrWljnZkxy2Yo0O8vryBVmNlFBfWmpZA7bD	103.118.98.118	2026-05-08	[{"path":"\\/","time":"02:05"},{"path":"\\/about-us","time":"02:06"}]	2026-05-08 02:05:38	2026-05-08 02:06:29
267	ROlpz054WX7NLfRQwelwnyjNPF5BY6qFtN1t0Hgs	66.249.66.32	2026-05-09	[{"path":"\\/saas-marketplace","time":"11:05"}]	2026-05-09 11:05:24	2026-05-09 11:05:25
264	UhmgijjBcIGs5woM9m6cGro9tfz48xzNNKLA9RKn	142.248.151.244	2026-05-08	[{"path":"\\/","time":"05:01"},{"path":"\\/services","time":"05:01"},{"path":"\\/portfolio","time":"05:01"}]	2026-05-08 05:01:30	2026-05-08 05:01:50
265	ZMJ4CHeTytD22DMAEKeDfYF8ld9eG001xfDkU53k	66.249.66.36	2026-05-08	[{"path":"\\/","time":"06:09"}]	2026-05-08 06:09:20	2026-05-08 06:09:20
268	o8ZohasnNHTFz6autr0FKLGeNAbaLBlyqJOyIbkc	66.249.66.75	2026-05-09	[{"path":"\\/register","time":"16:09"}]	2026-05-09 16:09:56	2026-05-09 16:09:56
269	I9kpD1NynqmDVQgJDJQHsbPi04OuWK7mG6ylyg95	52.167.144.157	2026-05-09	[{"path":"\\/contact","time":"22:45"}]	2026-05-09 22:45:11	2026-05-09 22:45:11
270	G6S8WDwtoPWErqIbOtEI4H3CN68obJeB8FklAxFG	182.8.122.145	2026-05-10	[{"path":"\\/about-us","time":"06:57"}]	2026-05-10 06:57:05	2026-05-10 06:57:06
271	lkS7WxgsXbaLBMuFinoSpdCrfmp1C7VqFhOuujNO	66.249.66.33	2026-05-10	[{"path":"\\/","time":"11:00"}]	2026-05-10 11:00:42	2026-05-10 11:00:42
272	iV6J19jd2qlyr6I26NljjsmPwvtWAiiwl7FG1zBo	66.249.66.42	2026-05-10	[{"path":"\\/","time":"14:44"}]	2026-05-10 14:44:34	2026-05-10 14:44:34
273	NbFFIlrR0l4ateGbX0AHk28NH0WGEDbNOG39sSCb	175.44.42.160	2026-05-10	[{"path":"\\/","time":"19:50"}]	2026-05-10 19:50:56	2026-05-10 19:50:56
274	9dbG57CIgN8YeKAWmq8B5XtBg5ETSgHL2JluGcDW	66.249.66.204	2026-05-10	[{"path":"\\/","time":"22:40"}]	2026-05-10 22:40:35	2026-05-10 22:40:35
275	ka76e579ollZGvd7Rdvvmn6n20zFNic5868Gmv7L	66.249.66.204	2026-05-10	[{"path":"\\/","time":"22:40"}]	2026-05-10 22:40:36	2026-05-10 22:40:37
276	MI6FaRfJKIHl4FFaE2DXtTjjSy6FLELwnr1jLX9n	103.147.8.92	2026-05-11	[{"path":"\\/","time":"03:43"}]	2026-05-11 03:43:58	2026-05-11 03:43:58
277	dBnxsvsIOQFeCtsoeA5RwULHp0xajds53IbbF22i	103.147.8.92	2026-05-11	[{"path":"\\/","time":"03:45"}]	2026-05-11 03:45:50	2026-05-11 03:45:50
278	T1XUHcPBDaltu6A3TazGof1cn5QjgdlL4HUJROle	103.118.98.118	2026-05-11	[{"path":"\\/","time":"04:06"}]	2026-05-11 04:06:18	2026-05-11 04:06:18
407	x7nHauPTJMhqtiR445WbtfPY6hh95FKgtnCugog1	103.145.244.208	2026-05-28	[{"path":"\\/","time":"10:55"}]	2026-05-28 10:55:09	2026-05-28 10:55:09
410	999invkVef8bTqGYPYQ8fbyUPkrM60J2uKEzFoXA	65.55.210.151	2026-05-29	[{"path":"\\/cpanel-hosting","time":"00:49"}]	2026-05-29 00:49:08	2026-05-29 00:49:08
280	pxThyhzM2VHp9WQkaR6MHWK1gQ0btfA5lUezEsAT	103.147.8.92	2026-05-11	[{"path":"\\/","time":"07:11"}]	2026-05-11 07:11:26	2026-05-11 07:11:26
281	4NX9aYlUssEZInIDX24kfaVEv0WMd6gQBsaHWuJT	140.213.106.73	2026-05-11	[{"path":"\\/","time":"07:14"}]	2026-05-11 07:14:32	2026-05-11 07:14:32
282	0AuXDiOWFKtEjy3DyxFYXizPhB5CQFMGSmdMBQmg	103.147.8.92	2026-05-11	[{"path":"\\/","time":"07:24"}]	2026-05-11 07:24:07	2026-05-11 07:24:07
283	FGjrUvQ9AueiovAV2H4brXTQSAmtHLG99daDcy5a	114.10.149.232	2026-05-11	[{"path":"\\/","time":"07:27"}]	2026-05-11 07:27:00	2026-05-11 07:27:01
284	VQ39CTx4dbvNRLwjkfMmXgN2yb7oGnh7bwbeyOJD	103.147.8.92	2026-05-11	[{"path":"\\/","time":"07:30"}]	2026-05-11 07:30:37	2026-05-11 07:30:37
285	pQUIhzlYAmtIADUW79Bx97ZgcmOuE9rQtC6cwolq	103.147.8.92	2026-05-11	[{"path":"\\/","time":"08:29"}]	2026-05-11 08:29:13	2026-05-11 08:29:13
286	mCjKgYYvIdppZ46sDFKwM4stSOV3PqUyA9hVxI41	103.147.8.92	2026-05-11	[{"path":"\\/","time":"08:31"}]	2026-05-11 08:31:21	2026-05-11 08:31:21
291	ZxYnofMeJAviPFfziuU8vVcKEV2y3eA8WTs0VMzg	103.147.8.92	2026-05-11	[{"path":"\\/login","time":"16:04"}]	2026-05-11 16:04:29	2026-05-11 16:04:29
292	4W6sF1WpMrIutwNoRwgLGaPsyClVm37DbgFyCHS4	103.156.164.75	2026-05-12	[{"path":"\\/","time":"01:13"}]	2026-05-12 01:13:58	2026-05-12 01:13:58
279	Jr9z8JVqYAPBhFdlOncIbJb0cx507d3TGMAoWv3k	103.147.8.92	2026-05-11	[{"path":"\\/","time":"07:07"},{"path":"\\/catalog","time":"07:08"},{"path":"\\/","time":"07:08"},{"path":"\\/login","time":"08:38"},{"path":"\\/","time":"08:39"},{"path":"\\/catalog","time":"09:19"},{"path":"\\/saas-marketplace","time":"09:20"},{"path":"\\/catalog","time":"09:20"},{"path":"\\/login","time":"09:27"}]	2026-05-11 07:07:55	2026-05-11 09:27:10
293	Hq46gLoiFNGrAxCyWGpXs4Ud0tGfrI982VabVzS8	103.141.61.140	2026-05-12	[{"path":"\\/","time":"03:41"}]	2026-05-12 03:41:18	2026-05-12 03:41:18
294	KBOfUPugsAgBuvwyOLMocSBhsdcoP3lJI9MEKAJL	173.252.127.23	2026-05-12	[{"path":"\\/","time":"06:28"}]	2026-05-12 06:28:36	2026-05-12 06:28:37
296	3T8c3hn4YDBJ1Tlb49LKC21xGmhPzgLZbkCsQkBh	182.253.150.4	2026-05-12	[{"path":"\\/admin\\/dashboard","time":"09:57"},{"path":"\\/admin\\/monitoring","time":"09:57"},{"path":"\\/admin\\/orders","time":"09:58"},{"path":"\\/admin\\/products","time":"09:58"},{"path":"\\/admin\\/saas-management","time":"09:59"},{"path":"\\/admin\\/admins","time":"09:59"},{"path":"\\/admin\\/users","time":"09:59"},{"path":"\\/admin\\/admins","time":"09:59"},{"path":"\\/admin\\/partners","time":"10:01"},{"path":"\\/admin\\/hero","time":"10:01"},{"path":"\\/admin\\/chatbot\\/responses","time":"10:02"}]	2026-05-12 09:57:34	2026-05-12 10:02:12
295	1tpxfBTzOvKqIvxuaCBH5F6kelLNMiHnsgmjA6GP	182.253.150.4	2026-05-12	[{"path":"\\/","time":"09:42"},{"path":"\\/login","time":"09:42"}]	2026-05-12 09:42:12	2026-05-12 09:42:18
288	Jc2Hu4F1lOS0e1MN1HkjJseFhlijjDebvQaGpz9J	182.253.150.3	2026-05-11	[{"path":"\\/","time":"11:24"}]	2026-05-11 11:24:31	2026-05-11 11:24:31
289	g39ecbD1F0rw8ecdOlOxr7oMEFh7v6pbqrAMHo75	103.156.164.75	2026-05-11	[{"path":"\\/","time":"11:25"}]	2026-05-11 11:25:48	2026-05-11 11:25:48
287	yuPwNqoksXcQ4jADynGlheYZHimxG8zBovu3SXWg	103.147.8.92	2026-05-11	[{"path":"\\/admin\\/dashboard","time":"09:36"},{"path":"\\/admin\\/monitoring","time":"09:36"},{"path":"\\/admin\\/orders","time":"09:37"},{"path":"\\/admin\\/hero","time":"09:37"},{"path":"\\/admin\\/products","time":"09:38"},{"path":"\\/admin\\/dashboard","time":"09:39"},{"path":"\\/admin\\/monitoring","time":"09:39"},{"path":"\\/","time":"13:04"},{"path":"\\/catalog","time":"13:04"}]	2026-05-11 09:36:23	2026-05-11 13:04:30
290	co3P8fK0Tueh9YM23Ww5Lj9ZYnZQfBaqEwtxEgJB	103.147.8.92	2026-05-11	[{"path":"\\/catalog","time":"16:04"}]	2026-05-11 16:04:28	2026-05-11 16:04:28
303	HeCFt0Zr0MAHb5beq6t2l7xKlZAaLUt9YIhvBcLy	182.253.228.99	2026-05-13	[{"path":"\\/","time":"11:56"}]	2026-05-13 11:56:50	2026-05-13 11:56:50
297	y5zyHdmgedgmoPr6IGT3OUg9tENZHpUZaqWXRk0I	103.147.8.92	2026-05-12	[{"path":"\\/","time":"12:38"},{"path":"\\/login","time":"12:38"}]	2026-05-12 12:38:29	2026-05-12 12:38:33
298	zMOYlZQK0hNkaumpggUA6vhrn5aBMfV3Bh7Wjtsv	52.167.144.166	2026-05-12	[{"path":"\\/about-us","time":"21:05"}]	2026-05-12 21:05:17	2026-05-12 21:05:17
299	rNFyKMctxPUKoxwYRqGzhxgJba0otQD8ze8xxpZD	40.77.179.251	2026-05-12	[{"path":"\\/","time":"22:20"}]	2026-05-12 22:20:09	2026-05-12 22:20:10
304	nUuJIvt16T3DcsbWZRYVhhmrPvBCVTWZfsilBQnI	182.8.228.112	2026-05-13	[{"path":"\\/","time":"12:43"},{"path":"\\/about-us","time":"12:44"}]	2026-05-13 12:43:16	2026-05-13 12:44:19
300	CE1gShasCmb0Bhb7DpmXZkpRkdng3c0pAXkb87zy	182.8.228.103	2026-05-13	[{"path":"\\/","time":"07:04"},{"path":"\\/services","time":"07:04"},{"path":"\\/portfolio","time":"07:04"},{"path":"\\/","time":"07:27"}]	2026-05-13 07:04:20	2026-05-13 07:27:22
305	RgDu7ewkwyCsh4hJlARle4K2PVNn8CTuJRDScffv	157.20.207.191	2026-05-13	[{"path":"\\/","time":"13:29"}]	2026-05-13 13:29:46	2026-05-13 13:29:46
301	Zu2VQTlDDPVFKpINElgkVedAPZOoIcofrU5X49qR	103.147.8.92	2026-05-13	[{"path":"\\/","time":"08:17"},{"path":"\\/catalog","time":"08:18"},{"path":"\\/","time":"08:18"}]	2026-05-13 08:17:26	2026-05-13 08:18:16
302	VtdiaMUCfwo1nYHCuW3BnQxvINeKpMugjoeBJiev	149.56.150.194	2026-05-13	[{"path":"\\/","time":"09:16"}]	2026-05-13 09:16:36	2026-05-13 09:16:36
306	11260mzsWfBP6Y9IPd6nGZ7XGBckXCmOJZ39Bno1	74.7.242.128	2026-05-13	[{"path":"\\/vps-hosting","time":"14:54"}]	2026-05-13 14:54:22	2026-05-13 14:54:22
311	VQ0yS03YwVlck58Rq1wQP3sjYGWmg2qMmi9IfzFP	66.249.68.5	2026-05-15	[{"path":"\\/","time":"11:48"}]	2026-05-15 11:48:57	2026-05-15 11:48:57
307	uuv7sdqXpE7FTb4tocs3MwlLqGOG6adtz8j2yDfK	180.247.59.154	2026-05-13	[{"path":"\\/","time":"17:57"},{"path":"\\/about-us","time":"17:57"}]	2026-05-13 17:57:10	2026-05-13 17:57:26
308	ZFvlYjsyBrSgrNm7DTdJ8TdUUDrnaKhdqPE5W5MC	104.194.206.237	2026-05-14	[{"path":"\\/","time":"02:10"}]	2026-05-14 02:10:58	2026-05-14 02:10:59
309	JVkTwp1bqHdgUWOqZU2nJ49OVBDw4GQtYRgaoUCo	52.167.144.220	2026-05-14	[{"path":"\\/","time":"11:16"}]	2026-05-14 11:16:07	2026-05-14 11:16:08
310	ziWBDW1mdGLLyLJtvuuZmreHeDJI4SKkaZtSGlbD	182.253.150.1	2026-05-15	[{"path":"\\/","time":"06:17"}]	2026-05-15 06:17:56	2026-05-15 06:17:59
312	ks6n9ZPUq59ZhIFTw8BodGW4TKO1HhDXSdUKw1b4	182.253.150.2	2026-05-16	[{"path":"\\/","time":"02:59"}]	2026-05-16 02:59:22	2026-05-16 02:59:22
313	FmyH32G8Vm3uxipFurfrUrtyYEZQPNatyiJ0GnqA	140.213.47.13	2026-05-16	[{"path":"\\/","time":"04:25"}]	2026-05-16 04:25:46	2026-05-16 04:25:46
314	IV2qUP7fnQhg33H2hNlubmjFol1oIbIy0FT1ztHU	114.8.224.202	2026-05-16	[{"path":"\\/","time":"14:45"}]	2026-05-16 14:45:24	2026-05-16 14:45:24
315	QsIOGnmMqYMgFKg9xd9RZWanGda9PqdqRTrIXFvJ	57.141.20.35	2026-05-16	[{"path":"\\/","time":"22:52"}]	2026-05-16 22:52:02	2026-05-16 22:52:03
316	4DvLQ1lomdkOD9jXISLwu1V646TRwM6pI9X6Rvju	173.252.87.16	2026-05-17	[{"path":"\\/","time":"01:13"}]	2026-05-17 01:13:35	2026-05-17 01:13:35
317	wJX83sxmRkFRFeka5xh7OXvYbakGKCJgN6WWh6lW	66.249.66.204	2026-05-17	[{"path":"\\/vps-hosting","time":"19:50"}]	2026-05-17 19:50:09	2026-05-17 19:50:12
318	8cuUOjsFkoB6bQjWIoPTFuMEPWaeYjT4hngDut4L	114.10.4.241	2026-05-18	[{"path":"\\/","time":"03:34"}]	2026-05-18 03:34:30	2026-05-18 03:34:30
319	5x7jL5MzSWmgEQ1EBnxJVq7SabMqpXdhNJ4EvsCG	202.8.41.192	2026-05-18	[{"path":"\\/","time":"05:23"}]	2026-05-18 05:23:52	2026-05-18 05:23:52
320	CbwUl6sNavy1etVRXPcK7pxxsrrfDjs9lptTWEvQ	66.249.66.36	2026-05-18	[{"path":"\\/","time":"10:05"}]	2026-05-18 10:05:19	2026-05-18 10:05:19
321	J9dledM7XX3mlEizH2xG70lrPqo53nM2ExDFItUr	182.253.150.2	2026-05-18	[{"path":"\\/","time":"10:48"}]	2026-05-18 10:48:50	2026-05-18 10:48:50
323	hJ05ZsKy1CKt4m2gZcF8pnJif1WeetgTF3JVyKKD	34.116.155.95	2026-05-18	[{"path":"\\/","time":"15:48"}]	2026-05-18 15:48:20	2026-05-18 15:48:20
324	KABDbRP64vEWLca9cRqaucn4csy6VRMEwgiERHJS	182.253.150.2	2026-05-18	[{"path":"\\/","time":"15:49"}]	2026-05-18 15:49:20	2026-05-18 15:49:20
405	FD8iQ6yqZshKGCVEY7NDIfGA82FteQVj8BK0bsiA	110.138.86.248	2026-05-28	[{"path":"\\/","time":"06:41"}]	2026-05-28 06:41:23	2026-05-28 06:41:23
346	Jjo1mHyH7FIwq03t1ItvPwSAAdGSJSLYB7jYn3nG	103.173.162.63	2026-05-20	[{"path":"\\/","time":"06:47"},{"path":"\\/about-us","time":"06:47"},{"path":"\\/","time":"06:47"}]	2026-05-20 06:47:03	2026-05-20 06:47:38
322	AKDGleK2gFwACzyCK1us8bFJL1Afb3xEdD29wGbv	182.253.150.2	2026-05-18	[{"path":"\\/","time":"15:47"},{"path":"\\/login","time":"15:50"},{"path":"\\/","time":"15:52"},{"path":"\\/catalog","time":"15:52"},{"path":"\\/","time":"15:57"}]	2026-05-18 15:47:48	2026-05-18 15:57:46
325	8GU2S4HYyRknRvtGzvyzBC4kJDaWm8WpuuhV5e1W	34.90.8.39	2026-05-18	[{"path":"\\/","time":"16:02"}]	2026-05-18 16:02:37	2026-05-18 16:02:37
326	YFYIy74VK0zt7lPduTbpSybGrXBKHe2GnqEWLqkh	52.167.144.21	2026-05-18	[{"path":"\\/faq","time":"16:28"}]	2026-05-18 16:28:51	2026-05-18 16:28:51
327	9wIx7brWSTN4NSI3vBh130HlS3y4NssbX5eI06UI	66.249.71.129	2026-05-18	[{"path":"\\/catalog","time":"21:55"}]	2026-05-18 21:55:53	2026-05-18 21:55:53
328	6XDLtNMHzEySodJS8TDj1B0oKFUhOYiGPPBkynsX	17.246.15.89	2026-05-19	[{"path":"\\/services","time":"00:59"}]	2026-05-19 00:59:14	2026-05-19 00:59:14
329	qSPdBQtxWBDRIFbLsDK7ycuNLWnc1wLpl0QdHoTD	182.253.150.2	2026-05-19	[{"path":"\\/","time":"01:51"}]	2026-05-19 01:51:58	2026-05-19 01:51:58
330	czywf5OWpEzniYpUZj9patYB3tgDp2ROapcZVl9b	182.253.150.2	2026-05-19	[{"path":"\\/","time":"02:14"}]	2026-05-19 02:14:26	2026-05-19 02:14:26
331	UZBA5GPl11PwsB6TMn385xAWpevlitzIN6BzC9Mj	182.253.150.3	2026-05-19	[{"path":"\\/","time":"05:00"}]	2026-05-19 05:00:24	2026-05-19 05:00:26
332	UQ9OKa4CORuUePGTjR5Ljl4robZKtgturZO76EMP	103.141.61.140	2026-05-19	[{"path":"\\/","time":"05:51"}]	2026-05-19 05:51:33	2026-05-19 05:51:33
333	D4RgKfh3I1FOOdUXo9flsomCKTICmPkVL4WBoFeI	66.249.66.7	2026-05-19	[{"path":"\\/","time":"06:36"}]	2026-05-19 06:36:33	2026-05-19 06:36:34
334	UCXPJifQeUdmxWRDTqlD2wQaWQRC0ARhX7eyboxa	66.249.66.42	2026-05-19	[{"path":"\\/","time":"06:37"}]	2026-05-19 06:37:05	2026-05-19 06:37:05
335	KoMjSwqKDm8UKTbfp1LuJV5PvRPPAVuXf3j9sbhS	66.249.66.42	2026-05-19	[{"path":"\\/","time":"07:57"}]	2026-05-19 07:57:22	2026-05-19 07:57:22
336	guGT1jJcLyeDEQWY7GSnUjaBMQyIaq70PMUSyUtX	66.249.66.42	2026-05-19	[{"path":"\\/","time":"07:57"}]	2026-05-19 07:57:24	2026-05-19 07:57:24
337	U1vUEK4y7bTH35e3xAjzSujrtfmgwwCoUpfpsou1	66.249.66.204	2026-05-19	[{"path":"\\/services","time":"08:41"}]	2026-05-19 08:41:28	2026-05-19 08:41:28
338	xwspSEF1dwNeRoUCC4amD60XwnBneuP3sixWy2lH	66.249.66.69	2026-05-19	[{"path":"\\/order\\/domain","time":"10:27"}]	2026-05-19 10:27:31	2026-05-19 10:27:31
339	Frsj8QLGndQfU2RjSbrLKgIJrBkCXYfPUKtOxj1s	40.77.167.28	2026-05-19	[{"path":"\\/register","time":"11:17"}]	2026-05-19 11:17:25	2026-05-19 11:17:25
340	btKmVSmRldsgTiO5PWUeSxdmKY16WDmjTDr8qkEQ	17.246.15.160	2026-05-19	[{"path":"\\/","time":"12:19"}]	2026-05-19 12:19:10	2026-05-19 12:19:10
341	7mHsl5S8fFaW2ydh8O7m2sNBYXhd38a0gV1VSokv	66.249.66.204	2026-05-19	[{"path":"\\/portfolio","time":"16:45"}]	2026-05-19 16:45:55	2026-05-19 16:45:55
342	9wIx7brWSTN4NSI3vBh130HlS3y4NssbX5eI06UI	66.249.71.130	2026-05-19	[{"path":"\\/domain-registration","time":"19:04"}]	2026-05-19 19:04:21	2026-05-19 19:04:21
343	lwDAJLlusfGr91AJQ7tEqGaeeoAOboDjle9B2h4f	182.253.228.97	2026-05-20	[{"path":"\\/","time":"02:24"}]	2026-05-20 02:24:24	2026-05-20 02:24:24
344	KOkT22zI6N3nC1U7HbE3ELANYRhXcGzEximC8qvt	114.10.5.29	2026-05-20	[{"path":"\\/","time":"03:38"}]	2026-05-20 03:38:31	2026-05-20 03:38:31
345	ZmpCaGrZH6R3hXUtDOYLeUXDCkzzYpR67aqBkzJF	114.10.5.29	2026-05-20	[{"path":"\\/","time":"04:57"}]	2026-05-20 04:57:23	2026-05-20 04:57:23
357	1Km5gQ5RBHMqOmHA6qYKt0BL0k6LdDSKsaKU0FFA	182.253.150.2	2026-05-22	[{"path":"\\/","time":"06:45"},{"path":"\\/register","time":"06:46"},{"path":"\\/login","time":"06:46"}]	2026-05-22 06:45:58	2026-05-22 06:46:19
347	HY5WpkxjJ5WGtcp35JFj6vpeTKDAjPgUhgcEG8vC	146.112.163.41	2026-05-20	[{"path":"\\/","time":"07:28"}]	2026-05-20 07:28:01	2026-05-20 07:28:01
348	Hwfh43t3WHaWc8vT3YAlQ6oOtKM2cBaTkxgRFtAC	66.249.66.5	2026-05-21	[{"path":"\\/register","time":"04:42"}]	2026-05-21 04:42:44	2026-05-21 04:42:44
349	XXl4HketuYmSmu2YJ5rVnSq5lv8x6SBgftwprumj	40.77.167.144	2026-05-21	[{"path":"\\/","time":"09:31"}]	2026-05-21 09:31:32	2026-05-21 09:31:33
350	4a94R9nIN2juUxCFFMEE4Z9WIgZ53qlp8x7eBGS5	66.249.66.204	2026-05-21	[{"path":"\\/portfolio","time":"13:39"}]	2026-05-21 13:39:19	2026-05-21 13:39:19
351	d15MDuD85f5MXbAD9Qhn9kVGNLXeM7fD7OWUrwUl	54.174.58.238	2026-05-22	[{"path":"\\/","time":"03:22"}]	2026-05-22 03:22:59	2026-05-22 03:22:59
352	F2ePtp2wbltzUnq2iT7Z9O1zSI1hnzeTVIvCcFZV	203.78.122.217	2026-05-22	[{"path":"\\/vps-hosting","time":"04:38"}]	2026-05-22 04:38:58	2026-05-22 04:38:58
353	szlEquXWMZJ06K2P0dWyMe4DoM3yNQfhzvo0J3un	205.169.39.162	2026-05-22	[{"path":"\\/","time":"04:54"}]	2026-05-22 04:54:23	2026-05-22 04:54:23
356	ecmmZ36p0xjFXGIMowS6qB0zdgru0fhEaz1Yi1O4	114.10.39.157	2026-05-22	[{"path":"\\/","time":"06:44"},{"path":"\\/services","time":"06:49"}]	2026-05-22 06:44:37	2026-05-22 06:49:40
354	MQ5YuKfHnom6ECBpyKtSrBPsgNgyioF8YCmDYQUg	182.253.150.2	2026-05-22	[{"path":"\\/","time":"06:37"},{"path":"\\/login","time":"06:37"}]	2026-05-22 06:37:24	2026-05-22 06:37:30
355	cqtuCUkS09ADCXWwDLefIYlNChquU5qZJMTCbCQC	182.253.150.2	2026-05-22	[{"path":"\\/login","time":"06:38"}]	2026-05-22 06:38:10	2026-05-22 06:38:11
358	4ImPtSTZe9d469ctm3Zh7eQs4JQUtcCzAJzifv17	182.253.150.2	2026-05-22	[{"path":"\\/admin\\/dashboard","time":"06:50"},{"path":"\\/admin\\/products","time":"06:50"},{"path":"\\/admin\\/orders","time":"06:50"},{"path":"\\/admin\\/orders\\/11","time":"06:50"},{"path":"\\/admin\\/admins","time":"06:50"},{"path":"\\/admin\\/users","time":"06:50"},{"path":"\\/admin\\/admins","time":"06:51"},{"path":"\\/admin\\/partners","time":"06:51"},{"path":"\\/admin\\/hero","time":"06:51"},{"path":"\\/admin\\/dashboard","time":"06:51"},{"path":"\\/admin\\/orders","time":"06:52"},{"path":"\\/admin\\/users","time":"06:52"},{"path":"\\/admin\\/users\\/5\\/edit","time":"06:52"},{"path":"\\/admin\\/users","time":"06:52"}]	2026-05-22 06:50:05	2026-05-22 06:52:31
359	HkixGI5zAt3AdOdXSrK80IRGN54uZz5MXimgrGlD	182.253.150.6	2026-05-22	[{"path":"\\/","time":"09:24"},{"path":"\\/login","time":"09:24"}]	2026-05-22 09:24:31	2026-05-22 09:24:41
406	BM4bzMO9jQJzpCtBz4bnHB6roqxy8CDdghz9furu	110.139.37.231	2026-05-28	[{"path":"\\/","time":"10:07"}]	2026-05-28 10:07:18	2026-05-28 10:07:20
408	XljkL0TacvXncz04yynwdWB6TZxClrwbwlVa0ckY	180.252.164.198	2026-05-28	[{"path":"\\/","time":"11:28"}]	2026-05-28 11:28:48	2026-05-28 11:28:48
409	XSRKtwvzJiMytF0VvBcbfEs6XZNYBSsNgATNiDMo	125.165.94.57	2026-05-28	[{"path":"\\/","time":"12:28"}]	2026-05-28 12:28:57	2026-05-28 12:28:57
411	gs3Ar9guZSZFyxbKkdGCqzGy09wgDslXur9BELrQ	182.3.50.7	2026-05-29	[{"path":"\\/","time":"05:45"}]	2026-05-29 05:45:40	2026-05-29 05:45:41
412	Uo5FyFrjYsCSy9RgE9UDLMdNsyLrNEJ8idICe91Z	114.8.221.10	2026-05-29	[{"path":"\\/","time":"06:33"}]	2026-05-29 06:33:32	2026-05-29 06:33:32
413	Bw1LE6re0D1JJNQYvPzoCiSHHN9jmwtzXSUpnl0i	118.99.107.133	2026-05-29	[{"path":"\\/","time":"08:06"}]	2026-05-29 08:06:40	2026-05-29 08:06:40
414	SCHC9189NCQ05iau3ts9ipV0g3RNoP54kHLU0oHr	66.249.79.8	2026-05-29	[{"path":"\\/register","time":"08:35"}]	2026-05-29 08:35:47	2026-05-29 08:35:47
378	0Ee9oT4iv4RbeNF1WFsNevbUppKqy7iW4CvRkob5	212.56.53.62	2026-05-24	[{"path":"\\/","time":"05:22"}]	2026-05-24 05:22:08	2026-05-24 05:22:08
360	vsz8i74mhGURg5Va77TVgc36GqjWyBzdGgCbId8w	182.253.150.6	2026-05-22	[{"path":"\\/","time":"09:25"},{"path":"\\/profile","time":"09:26"},{"path":"\\/cart","time":"09:26"},{"path":"\\/","time":"09:26"},{"path":"\\/catalog","time":"09:26"},{"path":"\\/services","time":"09:26"},{"path":"\\/client-area","time":"09:26"},{"path":"\\/client-area\\/products","time":"09:26"},{"path":"\\/client-area\\/domain","time":"09:26"},{"path":"\\/client-area\\/hosting","time":"09:27"},{"path":"\\/client-area\\/domain","time":"09:28"},{"path":"\\/client-area\\/products","time":"09:34"},{"path":"\\/client-area\\/domain","time":"09:34"},{"path":"\\/catalog","time":"09:34"},{"path":"\\/domain-registration","time":"09:35"},{"path":"\\/client-area","time":"09:35"},{"path":"\\/client-area\\/domain","time":"09:36"}]	2026-05-22 09:25:53	2026-05-22 09:36:17
362	Q5uE3TPJhZ3RxqIxe2ozVmWUM467wwarucHfIloh	17.241.219.9	2026-05-22	[{"path":"\\/domain-registration","time":"10:43"}]	2026-05-22 10:43:57	2026-05-22 10:43:57
361	8F3pVkSSX3EJEuyGJEVk5BxtmUOOXTObdK3RDZqj	182.253.228.96	2026-05-22	[{"path":"\\/","time":"09:37"},{"path":"\\/login","time":"11:15"}]	2026-05-22 09:37:21	2026-05-22 11:15:09
363	gP59UR4gTT8S0OJlzPRzQE5PdnBwGPorWXVTpsun	52.167.144.222	2026-05-22	[{"path":"\\/","time":"11:16"}]	2026-05-22 11:16:37	2026-05-22 11:16:37
364	qFZCLqxUDj9ijexX0eZWTkLdqJeNu0HuaORT4vZ6	182.10.98.83	2026-05-22	[{"path":"\\/","time":"11:54"}]	2026-05-22 11:54:59	2026-05-22 11:54:59
365	nlRBe5KUWLWII2qacI2I19wMiTAG6mi7mXcJAahX	66.249.79.7	2026-05-22	[{"path":"\\/domain-registration","time":"12:04"}]	2026-05-22 12:04:49	2026-05-22 12:04:49
379	nIeq5FjaHUsF0woEotGRBe5i0qYYNpPY97OqCmhD	36.65.0.126	2026-05-24	[{"path":"\\/","time":"07:45"}]	2026-05-24 07:45:55	2026-05-24 07:45:55
368	6oksnuGfTHWrS0HOe9dcsahoXj2WYNTmuEniil90	66.249.79.5	2026-05-22	[{"path":"\\/saas-marketplace","time":"13:53"}]	2026-05-22 13:53:15	2026-05-22 13:53:15
366	1HBGcaxMthsBuppW3XgeHIho3duC9SlGJEcALXHT	66.249.66.33	2026-05-22	[{"path":"\\/terms","time":"12:26"},{"path":"\\/","time":"16:14"}]	2026-05-22 12:26:41	2026-05-22 16:14:33
369	7mHsl5S8fFaW2ydh8O7m2sNBYXhd38a0gV1VSokv	66.249.66.75	2026-05-22	[{"path":"\\/","time":"16:16"}]	2026-05-22 16:16:01	2026-05-22 16:16:02
367	jCAczVZpY1T2NCX9LgJf6lOUBZeG7ZNOQJh3qlUg	66.249.79.7	2026-05-22	[{"path":"\\/portfolio","time":"12:26"},{"path":"\\/","time":"17:30"}]	2026-05-22 12:26:42	2026-05-22 17:30:16
370	I805GVkuHDmXUiKTIE7tiYtzX1n6j7IvJ8Lct4V3	66.249.71.128	2026-05-22	[{"path":"\\/saas-marketplace","time":"18:43"}]	2026-05-22 18:43:12	2026-05-22 18:43:12
371	YFN3cIxDodQZ1d47hXqIGpDwydN2m7oDat1FoTTP	52.167.144.158	2026-05-23	[{"path":"\\/about-us","time":"02:00"}]	2026-05-23 02:00:06	2026-05-23 02:00:07
372	RM8gIGYXOgYh6nztrqPz3jsYMJXtdaTPoEcvLCss	182.253.228.99	2026-05-23	[{"path":"\\/","time":"03:22"}]	2026-05-23 03:22:00	2026-05-23 03:22:00
373	3hYYOXCEr1ZSdcIP0YCSljD6rSG2CDpDVRzcl1He	66.249.79.202	2026-05-23	[{"path":"\\/","time":"03:47"}]	2026-05-23 03:47:29	2026-05-23 03:47:29
374	6ySMHRqFsHRQo3F125x1Ooj2dXDnTsFim8iBfNq8	66.249.79.203	2026-05-23	[{"path":"\\/","time":"05:02"}]	2026-05-23 05:02:28	2026-05-23 05:02:28
375	sc3xLrtt2poS4k1e0OB91vR1Ih3FuQrCj502Flve	17.246.19.7	2026-05-23	[{"path":"\\/domain-registration","time":"05:34"}]	2026-05-23 05:34:28	2026-05-23 05:34:28
376	njTecYmj056oRKb3jk7dNVZ8yHn0dPSmXXIsRWKk	182.8.228.89	2026-05-23	[{"path":"\\/","time":"13:15"}]	2026-05-23 13:15:24	2026-05-23 13:15:25
377	HYI0xnjGYCDg2SQwxCKI5EzM9IU0D5hdpp0sa4O7	66.249.66.36	2026-05-23	[{"path":"\\/saas-marketplace","time":"19:51"}]	2026-05-23 19:51:00	2026-05-23 19:51:00
380	VWgRBlKJZ7T08ZQSm5BLa0UEdUyhlgbs3OUuCGv5	180.252.160.175	2026-05-24	[{"path":"\\/","time":"12:22"}]	2026-05-24 12:22:47	2026-05-24 12:22:47
381	pVBweYkW6OHfRj1EtYkaUyRrCBO6OB9A3QzA3qUB	185.117.225.159	2026-05-24	[{"path":"\\/","time":"21:49"}]	2026-05-24 21:49:52	2026-05-24 21:49:52
389	hhrAF2CTki1riHFjGmB4MnkHZ86ayDIPfdEGq3D3	57.155.171.17	2026-05-26	[{"path":"\\/","time":"03:04"}]	2026-05-26 03:04:28	2026-05-26 03:04:28
382	hbTBmJl6fsxfLIIuYFK0PDq97iGdpSPhVVBKmYhZ	36.71.37.112	2026-05-25	[{"path":"\\/","time":"02:31"},{"path":"\\/services","time":"02:32"},{"path":"\\/portfolio","time":"02:32"}]	2026-05-25 02:31:50	2026-05-25 02:32:32
383	1OrjtG9WTwvnkdjIRBK1DaJbVkdHNxH7jU3d3ZkK	203.78.124.141	2026-05-25	[{"path":"\\/","time":"04:22"},{"path":"\\/login","time":"04:31"}]	2026-05-25 04:21:56	2026-05-25 04:31:02
384	T8T5wj2zpSgaKG4TKF5IJrZHVrvKQGw0p0R0rcPE	66.249.71.128	2026-05-25	[{"path":"\\/saas-marketplace","time":"05:10"}]	2026-05-25 05:10:30	2026-05-25 05:10:31
390	hgBLKjcyvrvlC3tauiyamXtTUBdsZqLUuwQCGynS	57.155.171.17	2026-05-26	[{"path":"\\/","time":"03:13"}]	2026-05-26 03:13:19	2026-05-26 03:13:19
386	A4EyP8AhQJBEkV5p1z2KtbsJXWRFRbE3sXxPWmUp	203.78.124.29	2026-05-25	[{"path":"\\/","time":"09:26"}]	2026-05-25 09:26:32	2026-05-25 09:26:32
387	1eO3HzjYpsQVDdaMzBIh2kWluG1FSTy94ItLK3TW	203.78.124.83	2026-05-25	[{"path":"\\/","time":"09:28"}]	2026-05-25 09:28:21	2026-05-25 09:28:21
385	mmsjaM4Kqp43KKHXnp1WYVsLJUF7Dk6CpC5dGUpq	182.253.228.99	2026-05-25	[{"path":"\\/","time":"09:16"},{"path":"\\/register","time":"10:21"}]	2026-05-25 09:16:14	2026-05-25 10:21:45
388	Fjg5ME1Sx7sb7Tm8JJTzO1HLQU9h3gZdktqzAxIn	74.7.243.240	2026-05-26	[{"path":"\\/refund-policy","time":"00:04"},{"path":"\\/order\\/vps","time":"00:09"}]	2026-05-26 00:04:31	2026-05-26 00:09:22
391	lEUtneDBP8tEfU4OiUAsMZm7veiWRIfCGoKINqCt	57.155.171.17	2026-05-26	[{"path":"\\/","time":"03:15"}]	2026-05-26 03:15:27	2026-05-26 03:15:27
395	NeB2lVKsAbzHb8OLgDSF0PKwY3BbHefuNaYN0LA9	103.147.8.30	2026-05-26	[{"path":"\\/","time":"07:17"}]	2026-05-26 07:17:28	2026-05-26 07:17:28
393	CKFGFYNZyjtQPznwEaO9nZX4URUwgBlsJOuelFaw	182.2.181.150	2026-05-26	[{"path":"\\/","time":"04:56"}]	2026-05-26 04:56:19	2026-05-26 04:56:20
392	YFN3cIxDodQZ1d47hXqIGpDwydN2m7oDat1FoTTP	40.77.177.142	2026-05-26	[{"path":"\\/portfolio","time":"04:47"},{"path":"\\/","time":"05:27"}]	2026-05-26 04:47:38	2026-05-26 05:27:47
394	x0coPXmFxtqnIKqZ5Q4T3gIMwiJ799KUIoOAS8EA	66.249.71.128	2026-05-26	[{"path":"\\/about-us","time":"06:25"}]	2026-05-26 06:25:27	2026-05-26 06:25:28
396	5SSYlyju7QOEV14ih9eTEIzcecjDDbYO4lRJXRqK	103.147.8.30	2026-05-26	[{"path":"\\/","time":"08:04"}]	2026-05-26 08:04:02	2026-05-26 08:04:03
397	Df0d66JHtYVz9YX9N0zgT31sCElf3Gc8XBBCy0BU	103.147.8.30	2026-05-26	[{"path":"\\/","time":"08:12"}]	2026-05-26 08:12:38	2026-05-26 08:12:39
398	RnS4V1W9F5zMo5XKkzgqqwBoX5kRNQE8NpS63HzG	103.147.8.30	2026-05-26	[{"path":"\\/","time":"08:24"}]	2026-05-26 08:24:21	2026-05-26 08:24:21
399	Oa892Lgj9UGAyT7WbZc0i5K0d9LBrB5sraYpg3Fa	103.147.8.30	2026-05-26	[{"path":"\\/","time":"08:25"}]	2026-05-26 08:25:27	2026-05-26 08:25:28
400	It99xwDy1DBas0K6hm6nLUKgrsWznLqclwZluEBb	103.147.8.30	2026-05-26	[{"path":"\\/","time":"08:25"}]	2026-05-26 08:25:50	2026-05-26 08:25:50
401	HAT8LbeamoriQtfeOmq1tpBOLzezB9MMrMbpBEJJ	114.8.220.44	2026-05-26	[{"path":"\\/","time":"22:57"}]	2026-05-26 22:57:26	2026-05-26 22:57:26
402	dXGjs387pHhDlboct860oqMA1tw1YWunbFU635T0	35.90.234.50	2026-05-27	[{"path":"\\/","time":"02:41"},{"path":"\\/login","time":"02:41"},{"path":"\\/","time":"02:42"}]	2026-05-27 02:41:34	2026-05-27 02:42:10
403	orTFHxaiWhijR0OULikF9mL3KfSRgTXVweGexP2i	66.249.66.32	2026-05-27	[{"path":"\\/terms","time":"22:29"}]	2026-05-27 22:29:08	2026-05-27 22:29:12
404	vwSw7KBnBKUmR8Ywzjb083hAJLJxiPTXqEVIzrHm	114.5.240.23	2026-05-28	[{"path":"\\/","time":"01:06"}]	2026-05-28 01:06:59	2026-05-28 01:06:59
440	RXWcJTWMFDj9L1UbAb9j8tp6upJl0Gw7I96VMGGX	66.249.79.7	2026-06-01	[{"path":"\\/domain-registration","time":"09:36"},{"path":"\\/order\\/cpanel","time":"10:22"}]	2026-06-01 09:36:58	2026-06-01 10:22:22
415	CmtzYYRqliers2L0sSdJLVRRlGPyTZfP77p6ui85	66.249.79.8	2026-05-29	[{"path":"\\/","time":"09:01"},{"path":"\\/saas-marketplace","time":"09:23"}]	2026-05-29 09:01:31	2026-05-29 09:23:13
417	MbdwnE0acN8nSqPciHoz2xL8XV95HwtgiYMkdqcb	66.249.71.130	2026-05-29	[{"path":"\\/refund-policy","time":"09:33"}]	2026-05-29 09:33:45	2026-05-29 09:33:45
418	M5nnZo6TVZ3aNM5SFdGqsvs9BUr38NUyq6IdGEvT	66.249.71.128	2026-05-29	[{"path":"\\/order\\/vps","time":"13:55"}]	2026-05-29 13:55:00	2026-05-29 13:55:01
419	n2cxzmRADWuxaNJicM7O4d0ojxYutWU1g1RgJoL6	66.249.71.129	2026-05-29	[{"path":"\\/faq","time":"14:10"}]	2026-05-29 14:10:23	2026-05-29 14:10:23
439	95OVXZihxfkgfzCA92mF2cB5iVklrE8RYXpJrQrX	66.249.79.7	2026-06-01	[{"path":"\\/order\\/domain","time":"08:59"},{"path":"\\/order\\/vps","time":"10:59"}]	2026-06-01 08:59:24	2026-06-01 10:59:50
420	bJeCnazW9XYl3IfkQCp9nx2osSYKXuKM0BQVnUuj	66.249.71.130	2026-05-29	[{"path":"\\/order\\/cpanel","time":"15:13"}]	2026-05-29 15:13:44	2026-05-29 15:13:44
416	mHgUk8InXDlrOzGvq4gjA6Smbr1hTceuC2IZRvWU	66.249.71.128	2026-05-29	[{"path":"\\/cpanel-hosting","time":"09:17"},{"path":"\\/portfolio","time":"14:23"},{"path":"\\/domain-registration","time":"16:12"}]	2026-05-29 09:17:04	2026-05-29 16:12:11
421	94VudTePD3Qbo1vmzfFJYqaq1tkc71dPwq48rPqD	66.249.68.67	2026-05-29	[{"path":"\\/","time":"22:21"}]	2026-05-29 22:21:07	2026-05-29 22:21:10
422	krAvqy2pjC0tQRPLqDVpB1sicxhLvhgxMOF4Zd5V	182.253.150.2	2026-05-30	[{"path":"\\/","time":"03:39"}]	2026-05-30 03:39:37	2026-05-30 03:39:37
423	GV77DH2AUyl8ND9PsdjA13AsRhHZjKBtyIN9ZH1j	182.8.228.44	2026-05-30	[{"path":"\\/","time":"11:51"}]	2026-05-30 11:51:14	2026-05-30 11:51:15
424	1Ce2MbRqOJQEphgrjieNDkQ2TSZuZPFkp157HSWE	140.213.103.169	2026-05-30	[{"path":"\\/","time":"13:55"}]	2026-05-30 13:55:29	2026-05-30 13:55:29
425	dLtxyBUzE7xeShoOPAn2P4KTihvNbiMhNYaIW5Eu	140.213.107.161	2026-05-30	[{"path":"\\/","time":"14:01"}]	2026-05-30 14:01:40	2026-05-30 14:01:40
426	aULBPa82tu914dBLXikHExHA1dtalb7Zb7P56fju	102.129.232.12	2026-05-30	[{"path":"\\/","time":"21:33"}]	2026-05-30 21:33:23	2026-05-30 21:33:24
427	TczczGYk7xCQblePp4AA2jHiMJnlQVjV1knOQEnH	66.249.71.128	2026-05-30	[{"path":"\\/login","time":"23:18"}]	2026-05-30 23:18:59	2026-05-30 23:18:59
428	999invkVef8bTqGYPYQ8fbyUPkrM60J2uKEzFoXA	52.167.144.147	2026-05-31	[{"path":"\\/about-us","time":"01:37"}]	2026-05-31 01:37:06	2026-05-31 01:37:06
429	CDa2a2FDNv4hkh8aQyEZpJ3mp1tvVZEi9670Wsoe	182.253.150.6	2026-05-31	[{"path":"\\/","time":"02:01"}]	2026-05-31 02:01:27	2026-05-31 02:01:27
430	6stSslXqV6xrRibbCIrHraA9Kt5AQtb5XqN8QOpD	182.8.228.72	2026-05-31	[{"path":"\\/","time":"03:56"}]	2026-05-31 03:56:45	2026-05-31 03:56:45
431	74XzT3V7yKT742D7L8MgpGOVXpdD6gd3jz7tzolk	52.167.144.156	2026-05-31	[{"path":"\\/terms","time":"07:45"}]	2026-05-31 07:45:15	2026-05-31 07:45:15
432	95OVXZihxfkgfzCA92mF2cB5iVklrE8RYXpJrQrX	66.249.79.1	2026-05-31	[{"path":"\\/","time":"15:52"}]	2026-05-31 15:52:09	2026-05-31 15:52:10
433	joaZavk74CDCHawMaJvTx1TMxHO1KZ3I0qEzh1Ye	66.249.71.129	2026-05-31	[{"path":"\\/saas-marketplace","time":"22:43"}]	2026-05-31 22:43:51	2026-05-31 22:43:51
434	ZHAkmzhKUnGyaDv407QZRYp9Rz02mVRbkJz9W0tz	66.249.79.202	2026-05-31	[{"path":"\\/","time":"23:49"}]	2026-05-31 23:49:54	2026-05-31 23:49:55
435	RXr0NXxIAi96ep6Y1GDgga8sovEu50u8m8jc2KoV	31.13.115.4	2026-06-01	[{"path":"\\/","time":"03:01"}]	2026-06-01 03:01:09	2026-06-01 03:01:10
436	ZzxTdnvuqzidLCgtEPiVXtZGYWQl6NKT6IIDbJlv	66.249.66.203	2026-06-01	[{"path":"\\/","time":"03:47"}]	2026-06-01 03:47:30	2026-06-01 03:47:30
437	mHgUk8InXDlrOzGvq4gjA6Smbr1hTceuC2IZRvWU	66.249.71.128	2026-06-01	[{"path":"\\/catalog","time":"06:53"}]	2026-06-01 06:53:49	2026-06-01 06:53:49
438	rshRnjGn2t1RQXySYjMlzw2yeJsnULMxg2oaaPi5	66.249.79.7	2026-06-01	[{"path":"\\/register","time":"07:44"}]	2026-06-01 07:44:32	2026-06-01 07:44:33
451	BSsD7GBxwFjxZH9IikqTdLiOwxHkPQxSJNrI0K1e	66.249.66.202	2026-06-02	[{"path":"\\/","time":"16:27"}]	2026-06-02 16:27:15	2026-06-02 16:27:17
441	XSRK2C1M6bojED4izkBxF0kxr5EdDZQvTEG4JYUt	66.249.79.8	2026-06-01	[{"path":"\\/login","time":"11:38"}]	2026-06-01 11:38:23	2026-06-01 11:38:23
442	mBaHheSuzc4JUwFvqhwHdxSOngPnvAKZDOo99oy9	79.127.132.177	2026-06-01	[{"path":"\\/","time":"17:40"}]	2026-06-01 17:40:57	2026-06-01 17:40:58
443	afxTleRnVmdG1U7Onf0RV8yNuzJ4dpqg0XCQj5TR	17.246.23.126	2026-06-01	[{"path":"\\/domain-registration","time":"18:40"}]	2026-06-01 18:40:06	2026-06-01 18:40:07
444	wnhzLCk5OcNtgd2BnwLZbsczMVIO2fFnIj9tgSnB	66.249.66.32	2026-06-01	[{"path":"\\/login","time":"20:22"}]	2026-06-01 20:22:21	2026-06-01 20:22:21
445	BSsD7GBxwFjxZH9IikqTdLiOwxHkPQxSJNrI0K1e	66.249.66.11	2026-06-01	[{"path":"\\/order\\/saas","time":"21:57"}]	2026-06-01 21:57:46	2026-06-01 21:57:46
446	tahp2TXtI4iojl98G8Xq3JJg7wCqrBsGPhV7ZzuN	66.249.71.128	2026-06-02	[{"path":"\\/login","time":"00:03"}]	2026-06-02 00:03:40	2026-06-02 00:03:40
447	kHxdvMy3okrPKSG0aoX4jGsPeqMyiOK48auSkay1	114.10.4.107	2026-06-02	[{"path":"\\/","time":"01:51"}]	2026-06-02 01:51:50	2026-06-02 01:51:50
448	zcKA2jYwDs1aU0fyFRD4cHmUiusU2XccjvCYgDwz	112.215.133.210	2026-06-02	[{"path":"\\/","time":"08:44"}]	2026-06-02 08:44:45	2026-06-02 08:44:46
449	E2ejQWqKUTMSpoOEm9WviW0v7wooXgh8VvmIDGIZ	66.249.79.8	2026-06-02	[{"path":"\\/contact","time":"10:41"}]	2026-06-02 10:41:22	2026-06-02 10:41:22
450	CQYkAK77rsgzefSRCCWJcakvT0tXW9j33ZgY6L1g	66.249.79.1	2026-06-02	[{"path":"\\/saas-marketplace","time":"10:43"}]	2026-06-02 10:43:09	2026-06-02 10:43:09
452	joaZavk74CDCHawMaJvTx1TMxHO1KZ3I0qEzh1Ye	66.249.66.202	2026-06-02	[{"path":"\\/","time":"16:27"}]	2026-06-02 16:27:16	2026-06-02 16:27:18
453	bRVA3QBnwJEICR6tXqplHZNcUKLYohdrKFGCR0kZ	66.249.66.202	2026-06-02	[{"path":"\\/","time":"21:04"}]	2026-06-02 21:04:57	2026-06-02 21:04:57
454	nXCzdPw5iZYaTM4DKPWOYvnW0aF2QzCbzGWgp4VE	182.8.228.41	2026-06-03	[{"path":"\\/","time":"00:56"}]	2026-06-03 00:56:29	2026-06-03 00:56:29
455	PdEsZ3zDRipGlkRSUIZsKkaRH5XPC7vbfnYrYwnh	114.10.20.138	2026-06-03	[{"path":"\\/","time":"02:35"}]	2026-06-03 02:35:15	2026-06-03 02:35:15
457	ppTBt1ec09uztFvSFsGPbbWdAobPyvIRNVUP1P8g	103.147.8.130	2026-06-03	[{"path":"\\/","time":"03:00"}]	2026-06-03 03:00:13	2026-06-03 03:00:14
458	AyclcV069ATWBhiLCxppoctE1NTA8zXMod9aaTxj	103.173.162.63	2026-06-03	[{"path":"\\/","time":"03:32"}]	2026-06-03 03:32:15	2026-06-03 03:32:16
459	ajQ4BS1Y2IjnfyaWY6xoDiHU3ORnEGWetKdzU2p4	50.17.171.243	2026-06-03	[{"path":"\\/","time":"04:29"}]	2026-06-03 04:29:48	2026-06-03 04:29:48
460	Xf01cUJdgeM2CCES1RTQpRXi7dPypx2AhP2LeuAH	103.147.8.130	2026-06-03	[{"path":"\\/login","time":"04:34"}]	2026-06-03 04:34:43	2026-06-03 04:34:44
461	dJn0SnhPmZq2zvlSPRCdr0wKuSV0ooFvzo2MjtpX	103.147.8.130	2026-06-03	[{"path":"\\/","time":"04:34"},{"path":"\\/domain-registration","time":"04:50"},{"path":"\\/join-partner","time":"04:52"},{"path":"\\/cart","time":"04:53"},{"path":"\\/catalog","time":"04:53"},{"path":"\\/client-area","time":"04:54"},{"path":"\\/client-area\\/domain","time":"04:54"}]	2026-06-03 04:34:53	2026-06-03 04:54:30
462	jOqKDnURPTo8zKFt1yuguV6i8C0bJtzrseOrUevS	54.80.52.232	2026-06-03	[{"path":"\\/login","time":"04:36"}]	2026-06-03 04:36:39	2026-06-03 04:36:39
478	0T4ATO3Cou6AbdoVcTOScKKPz6aA8rV6ETh86mdg	54.166.190.117	2026-06-03	[{"path":"\\/cpanel-hosting","time":"05:07"}]	2026-06-03 05:07:53	2026-06-03 05:07:53
472	95jZKE89YprbjrZ3VrLxSLSPR1RpVAScyZn5G6Ws	54.208.93.6	2026-06-03	[{"path":"\\/client-area","time":"04:58"}]	2026-06-03 04:58:10	2026-06-03 04:58:10
463	R4yvLYTvtmIs5wrNEN4hV9tIsifoF16EDx1oq1BC	100.54.195.150	2026-06-03	[{"path":"\\/faq","time":"04:37"}]	2026-06-03 04:37:46	2026-06-03 04:37:46
464	q1iDBllGcu9AViiuQKQMu96Jp1TnCKE7EcQcyx0A	3.87.159.146	2026-06-03	[{"path":"\\/services","time":"04:38"}]	2026-06-03 04:38:45	2026-06-03 04:38:45
465	YV6MsA8JpR9AXzegYNyf1jAd6UmKsr6fui6obhyP	54.197.209.36	2026-06-03	[{"path":"\\/about-us","time":"04:38"}]	2026-06-03 04:38:57	2026-06-03 04:38:57
473	VIAXgKvBAVQnZMmrwjqQnu8YAYXl73KFRnDxDxIs	32.198.119.237	2026-06-03	[{"path":"\\/cart","time":"04:58"}]	2026-06-03 04:58:30	2026-06-03 04:58:30
466	wEiB6YCpEKTQb9Ng4F3SCSjECU2afPsoSLO1zJF1	54.209.38.12	2026-06-03	[{"path":"\\/services","time":"04:41"}]	2026-06-03 04:41:19	2026-06-03 04:41:19
479	lQJPMedQ35KMWhUodQNlWmg6ySaKOddPA9ncWDeF	52.201.249.199	2026-06-03	[{"path":"\\/vps-hosting","time":"05:12"}]	2026-06-03 05:12:35	2026-06-03 05:12:35
467	HULDnfSdfEKbXxvrL6jMKYbANKdhJKEa4QyeRccL	34.229.39.15	2026-06-03	[{"path":"\\/","time":"04:43"}]	2026-06-03 04:43:30	2026-06-03 04:43:30
468	9dl8WeiVydzDhKvKmDD6e8VMcwEAxzn7UEYcIZB4	54.242.88.86	2026-06-03	[{"path":"\\/portfolio","time":"04:45"}]	2026-06-03 04:45:39	2026-06-03 04:45:39
469	Kw8KyekCoOxgxzeHRs4dnCp5ihM4KubeeZTE0a9I	114.10.20.138	2026-06-03	[{"path":"\\/","time":"04:47"}]	2026-06-03 04:47:00	2026-06-03 04:47:00
470	hWD7yRWxOyYoYucOMwcx4SIOyaA9rVFx7ZWdWSMA	54.157.222.200	2026-06-03	[{"path":"\\/contact","time":"04:48"}]	2026-06-03 04:48:56	2026-06-03 04:48:56
471	QxXwCQVQ6LDZmUJKyrfmfRtuaZPV0NdgT4fyxSip	54.80.144.185	2026-06-03	[{"path":"\\/join-partner","time":"04:56"}]	2026-06-03 04:56:13	2026-06-03 04:56:13
474	XhitbcMwV2hjvaUrSUkMrUJeN31RRKLLYaN6tPVM	100.30.223.145	2026-06-03	[{"path":"\\/client-area\\/domain","time":"04:59"}]	2026-06-03 04:59:03	2026-06-03 04:59:03
475	nZBipmCIsYhOLxyfDYPOrwC5CLSaR7pwSQrKnr3M	54.211.156.250	2026-06-03	[{"path":"\\/saas\\/business-email","time":"05:02"}]	2026-06-03 05:02:15	2026-06-03 05:02:17
476	EvvWS5Fm7fRclfaHZj0RlEGgD26JEWiGF0nhSTgv	100.30.223.145	2026-06-03	[{"path":"\\/vps-hosting","time":"05:03"}]	2026-06-03 05:03:06	2026-06-03 05:03:07
490	cU0VC1B71mmIfGpCcK09eZIJU9f6r7JaeGrDxbbm	100.30.173.241	2026-06-03	[{"path":"\\/","time":"06:39"}]	2026-06-03 06:39:14	2026-06-03 06:39:15
477	OgTbXATYY3vFruk6ryi10CDSbzfEJsqcmTRUhNHr	3.92.76.161	2026-06-03	[{"path":"\\/saas-marketplace","time":"05:05"}]	2026-06-03 05:05:50	2026-06-03 05:05:50
456	f4rQHD6n3Uk9jzDqPSoUaDmyxDufmlhhdGKYbJay	103.147.8.75	2026-06-03	[{"path":"\\/","time":"02:56"},{"path":"\\/terms","time":"03:30"},{"path":"\\/refund-policy","time":"03:31"},{"path":"\\/","time":"04:27"},{"path":"\\/register","time":"04:33"},{"path":"\\/faq","time":"04:36"},{"path":"\\/services","time":"04:36"},{"path":"\\/about-us","time":"04:37"},{"path":"\\/contact","time":"04:37"},{"path":"\\/about-us","time":"04:37"},{"path":"\\/faq","time":"04:37"},{"path":"\\/services","time":"04:39"},{"path":"\\/","time":"04:41"},{"path":"\\/portfolio","time":"04:43"},{"path":"\\/contact","time":"04:43"},{"path":"\\/saas-marketplace","time":"04:56"},{"path":"\\/saas\\/business-email","time":"04:57"},{"path":"\\/saas-marketplace","time":"04:58"},{"path":"\\/vps-hosting","time":"04:59"},{"path":"\\/cpanel-hosting","time":"05:03"},{"path":"\\/vps-hosting","time":"05:06"}]	2026-06-03 02:56:39	2026-06-03 05:06:45
485	GyEmgF8Na07ZykIa0tdanKi5OTFQoQr1R1etIqHO	54.204.210.202	2026-06-03	[{"path":"\\/contact","time":"06:23"}]	2026-06-03 06:23:36	2026-06-03 06:23:36
481	3LBmUqoaQlzHjgRfOgD2bhznEIbU1btpthqePti0	98.80.64.221	2026-06-03	[{"path":"\\/portfolio","time":"06:07"}]	2026-06-03 06:07:18	2026-06-03 06:07:19
486	C4OwUxI38mhuJKIknW6Z1l5TAYn1rIwXxGqqZxgC	35.175.208.239	2026-06-03	[{"path":"\\/login","time":"06:24"}]	2026-06-03 06:24:43	2026-06-03 06:24:43
482	JxM6TiCEHJEr8uK6SXBBaXDYBqQg7Nq6HpCumLpk	98.93.170.151	2026-06-03	[{"path":"\\/saas-marketplace","time":"06:09"}]	2026-06-03 06:09:35	2026-06-03 06:09:36
487	Xs48OLkTNTnM8l6R47iyPoPW6hnTcGHOGwJ8w5ED	34.229.118.179	2026-06-03	[{"path":"\\/","time":"06:24"}]	2026-06-03 06:24:45	2026-06-03 06:24:45
480	VjqI1s9UGwTqdZRM6cYx3p6dzuepMBEgJj9MwJtx	103.141.61.140	2026-06-03	[{"path":"\\/portfolio","time":"06:05"},{"path":"\\/saas-marketplace","time":"06:06"},{"path":"\\/cpanel-hosting","time":"06:06"},{"path":"\\/vps-hosting","time":"06:06"},{"path":"\\/refund-policy","time":"06:07"},{"path":"\\/vps-hosting","time":"06:08"},{"path":"\\/contact","time":"06:21"},{"path":"\\/login","time":"06:21"}]	2026-06-03 06:05:47	2026-06-03 06:21:32
483	SG1nt4Er1YvfJ9GZNo8AR7C0ZUOFpdF4tf6vSHDC	103.141.61.140	2026-06-03	[{"path":"\\/login","time":"06:21"}]	2026-06-03 06:21:41	2026-06-03 06:21:41
492	g1HWAeKs9FAHUzrydprwD4caGGxNdWFI8eZo7nEI	100.30.188.112	2026-06-03	[{"path":"\\/about-us","time":"06:41"}]	2026-06-03 06:41:49	2026-06-03 06:41:49
488	4tMqPVPcyQKa7G513AFz7Upha1rjKqxiWRniPfaS	3.87.134.221	2026-06-03	[{"path":"\\/contact","time":"06:26"}]	2026-06-03 06:26:07	2026-06-03 06:26:08
489	1Za0FNvTPSGS5fysaS2uKKbgU7FK1PBsmC1u2gfk	116.202.240.113	2026-06-03	[{"path":"\\/","time":"06:28"}]	2026-06-03 06:28:16	2026-06-03 06:28:16
491	gDkwjsJtYlJAusF2RFghuhhXx3OCOl9Oj2OA8pya	34.230.52.231	2026-06-03	[{"path":"\\/catalog","time":"06:39"}]	2026-06-03 06:39:26	2026-06-03 06:39:26
493	FeamwI8XrUE2qgc7gCcZlU0zarOja0TLh11VAhRA	52.55.106.216	2026-06-03	[{"path":"\\/catalog","time":"06:44"}]	2026-06-03 06:44:02	2026-06-03 06:44:02
494	jWo9mFXBJXdEhcbVfgNY3rch8fEVGMpYF7sJQCa7	18.212.153.209	2026-06-03	[{"path":"\\/services","time":"06:44"}]	2026-06-03 06:44:47	2026-06-03 06:44:47
495	4B1WJo74YSWGb50Jmes3BvTJUrXDgt9vGAaV3Xqx	54.208.93.6	2026-06-03	[{"path":"\\/domain-registration","time":"06:45"}]	2026-06-03 06:45:53	2026-06-03 06:45:53
496	lJOvONMYgA8RUK5GDR03d31K3OaSbg3L6bSthMh2	54.166.190.117	2026-06-03	[{"path":"\\/order\\/domain","time":"06:46"}]	2026-06-03 06:46:16	2026-06-03 06:46:16
497	mDVzWORIJlWLUdH1BSvvgXiuvzCOpTzsdaKEFunn	3.80.191.29	2026-06-03	[{"path":"\\/checkout","time":"06:46"}]	2026-06-03 06:46:19	2026-06-03 06:46:19
543	1CteGu6PIWC4mhiQCV0iU2a959GPUfrSBfRKC0X1	102.129.234.217	2026-06-05	[{"path":"\\/","time":"05:45"}]	2026-06-05 05:45:30	2026-06-05 05:45:30
547	BI1egLmCA9iqcBnGD9cXLnRPYZ4khNjp8Sjx4ue1	71.6.235.210	2026-06-05	[{"path":"\\/","time":"10:19"}]	2026-06-05 10:19:30	2026-06-05 10:19:31
551	t4yZSQoPS4GYgslgwAXHVKZ4YQxBa2p0ewwlZmMX	66.249.79.8	2026-06-06	[{"path":"\\/","time":"07:36"}]	2026-06-06 07:36:26	2026-06-06 07:36:26
555	EVEdpvgKWf361HQdkyq4c6fnN9GCLWPKVeZxtBrj	154.3.224.141	2026-06-07	[{"path":"\\/","time":"14:35"}]	2026-06-07 14:35:56	2026-06-07 14:35:57
559	0S6sVlGafPjC6bB5tNK5kmL7ttkqdC1EzdYiTQiT	40.77.177.138	2026-06-07	[{"path":"\\/services","time":"23:45"}]	2026-06-07 23:45:12	2026-06-07 23:45:13
563	nzjS5wcfcznfhVn1EwgFQ8mCwVDI3Zmvvm0iXf0F	66.249.66.202	2026-06-08	[{"path":"\\/portfolio","time":"18:18"}]	2026-06-08 18:18:42	2026-06-08 18:18:42
567	lq3WcO50yynOfOvwTMBpOTu2Q2kfA3jGzg2jr5Ka	182.8.228.122	2026-06-10	[{"path":"\\/","time":"13:46"}]	2026-06-10 13:46:03	2026-06-10 13:46:03
571	dFdHIVzwkdaJhwnyjlgAAcgGdq9uEI3sya9XgAJx	182.8.228.110	2026-06-10	[{"path":"\\/about-us","time":"21:29"}]	2026-06-10 21:29:56	2026-06-10 21:29:56
575	U3L5bGlKb9qRDCrlsLkDZSI0xNXqWoTrBhs33Meu	17.246.19.123	2026-06-11	[{"path":"\\/domain-registration","time":"00:51"}]	2026-06-11 00:51:25	2026-06-11 00:51:25
524	8uZQXSdb8z0HsmYwJ7GJyb15oYJRt2jMNjb7Iasi	114.122.82.239	2026-06-03	[{"path":"\\/profile","time":"08:02"},{"path":"\\/catalog","time":"08:03"},{"path":"\\/order\\/cpanel","time":"08:03"},{"path":"\\/cart","time":"08:04"},{"path":"\\/checkout","time":"08:05"},{"path":"\\/order\\/instruction\\/15","time":"08:05"},{"path":"\\/join-partner","time":"08:07"},{"path":"\\/services","time":"08:07"},{"path":"\\/cart","time":"08:08"},{"path":"\\/catalog","time":"08:08"},{"path":"\\/domain-registration","time":"08:08"},{"path":"\\/about-us","time":"08:20"},{"path":"\\/portfolio","time":"08:21"},{"path":"\\/contact","time":"08:27"},{"path":"\\/about-us","time":"08:28"},{"path":"\\/contact","time":"08:28"},{"path":"\\/faq","time":"08:29"},{"path":"\\/contact","time":"08:29"},{"path":"\\/","time":"08:29"},{"path":"\\/domain-registration","time":"08:29"},{"path":"\\/order\\/domain","time":"08:30"},{"path":"\\/cart","time":"08:30"},{"path":"\\/checkout","time":"08:30"},{"path":"\\/order\\/instruction\\/16","time":"08:30"},{"path":"\\/client-area\\/invoices","time":"08:30"},{"path":"\\/","time":"08:31"},{"path":"\\/vps-hosting","time":"08:32"},{"path":"\\/order\\/vps","time":"08:32"},{"path":"\\/cart","time":"08:32"},{"path":"\\/checkout","time":"08:33"},{"path":"\\/order\\/instruction\\/17","time":"08:33"},{"path":"\\/client-area\\/invoices","time":"08:33"}]	2026-06-03 08:02:27	2026-06-03 08:33:55
544	TkwF7cPsTtuJ8v2nAAjvRZT1zE0QG1vNd8Zsq7Xx	71.6.235.141	2026-06-05	[{"path":"\\/","time":"08:00"}]	2026-06-05 08:00:38	2026-06-05 08:00:39
588	BaKjXeueRo4FVAYj5i2QztjrLBslbfPR6Sx1CGEp	66.249.79.7	2026-06-11	[{"path":"\\/catalog","time":"16:07"}]	2026-06-11 16:07:19	2026-06-11 16:07:20
548	kvcKf2OfR5fl6yW2VcvhpFWNR5UnLdtsZ0MkWzZF	172.104.225.200	2026-06-05	[{"path":"\\/","time":"10:27"}]	2026-06-05 10:27:35	2026-06-05 10:27:36
552	nqZzPUJEbLzkxPp6jm3rmUWfijLERJDhbllZJo0H	66.249.79.7	2026-06-06	[{"path":"\\/","time":"07:36"}]	2026-06-06 07:36:46	2026-06-06 07:36:46
556	TU6JBdU2H6v7dZtTyyaNZ0SXRVGcRNSzA49GUIPF	103.147.8.45	2026-06-07	[{"path":"\\/","time":"15:08"}]	2026-06-07 15:08:17	2026-06-07 15:08:17
560	zNa8VcyQpq7iUaf6PdNHA4ijppZ9TQwqPMB8VGep	66.249.71.128	2026-06-08	[{"path":"\\/register","time":"02:20"}]	2026-06-08 02:20:39	2026-06-08 02:20:39
564	no66noQhMjNrqa3zVi0O0v2UHD6508GrgYjN4VHd	182.253.228.99	2026-06-09	[{"path":"\\/","time":"08:34"}]	2026-06-09 08:34:32	2026-06-09 08:34:32
568	oV060bf4WagK4371yqSBpiyc2EFOQwZN42ihZONg	66.249.79.202	2026-06-10	[{"path":"\\/","time":"15:49"},{"path":"\\/domain-registration","time":"18:18"}]	2026-06-10 15:49:20	2026-06-10 18:18:06
572	0HNQsYU5nvjXGeVMkOLQmKTRkthCHpEBnaYtMO6D	66.249.79.7	2026-06-10	[{"path":"\\/","time":"22:55"}]	2026-06-10 22:55:12	2026-06-10 22:55:13
576	FHCV5GFBLT7b4fWFYyE9ga8sxqkPBkJ5t7LLuHoq	207.46.13.78	2026-06-11	[{"path":"\\/","time":"06:52"}]	2026-06-11 06:52:41	2026-06-11 06:52:41
579	iZETNgz67QVZXjeDo82vyEnLI0a2cXh8rrkaeSpn	17.22.237.243	2026-06-11	[{"path":"\\/domain-registration","time":"08:51"}]	2026-06-11 08:51:18	2026-06-11 08:51:18
582	Wx6ki3ECljV6NieUxdezFZvAgsBybxcX4IbIbz0K	66.249.71.128	2026-06-11	[{"path":"\\/domain-registration","time":"13:03"}]	2026-06-11 13:03:39	2026-06-11 13:03:39
591	Avw5bPiw4ObMblRjMIWwppdNIu3M8AkGKVMymCC1	66.249.66.204	2026-06-13	[{"path":"\\/domain-registration","time":"18:21"}]	2026-06-13 18:21:16	2026-06-13 18:21:17
585	79KPFYExqhQmxDvjPnLms63MTrY8z2jPIjRLbDHZ	66.249.79.7	2026-06-11	[{"path":"\\/saas-marketplace","time":"16:05"},{"path":"\\/saas\\/business-email","time":"16:06"}]	2026-06-11 16:05:59	2026-06-11 16:06:24
630	HJllOF4A5641Sag7D6vegP90a0ThkPq7Mw7Okgu6	66.249.79.8	2026-06-23	[{"path":"\\/saas-marketplace","time":"16:42"}]	2026-06-23 16:42:29	2026-06-23 16:42:29
594	rmXlLy8FFtuR9JrPCW65fF3myX7pRQxbG7AMB2UA	114.10.104.174	2026-06-15	[{"path":"\\/about-us","time":"11:31"},{"path":"\\/catalog","time":"11:31"}]	2026-06-15 11:31:17	2026-06-15 11:31:38
597	yziPRGSpGYhzV9wp5K29Qh7WRgRjP4CRf7HqRUMT	66.249.79.5	2026-06-16	[{"path":"\\/domain-registration","time":"23:01"}]	2026-06-16 23:01:33	2026-06-16 23:01:33
600	xUuNQAr5vZpYz4NutXrR77HI9Baaisa45Sn1HGAn	182.253.228.97	2026-06-17	[{"path":"\\/","time":"03:27"}]	2026-06-17 03:27:38	2026-06-17 03:27:38
603	LWgSnInWgeeokH3P1KDDNNp2rCLZyhvAarLDOkxW	114.10.6.47	2026-06-17	[{"path":"\\/","time":"03:40"}]	2026-06-17 03:40:07	2026-06-17 03:40:08
606	UagT2PnBP2dOOAoKFuWICDRQepRvCzsiTwUMdafU	69.63.184.19	2026-06-17	[{"path":"\\/","time":"09:41"}]	2026-06-17 09:41:19	2026-06-17 09:41:19
609	exudoxWVOjxPq2hLRWpTlVDUWEwJ2caoxcClzUIz	66.249.79.6	2026-06-18	[{"path":"\\/login","time":"03:31"}]	2026-06-18 03:31:37	2026-06-18 03:31:38
612	lTy8IRlZzNfQalhcCIQvhox3cVahVlTMMbN5VhbU	66.249.79.36	2026-06-18	[{"path":"\\/","time":"15:18"}]	2026-06-18 15:18:47	2026-06-18 15:18:47
615	zPtkna8FAeVMuf7pGFoh3jBxJcMVmKL0rQpnVpZ4	52.167.144.218	2026-06-19	[{"path":"\\/services","time":"15:17"}]	2026-06-19 15:17:36	2026-06-19 15:17:36
618	P8vNbU6cQaTVCzFisb86pJypp6mCLACE8dZFqo1f	40.77.179.23	2026-06-20	[{"path":"\\/contact","time":"23:15"}]	2026-06-20 23:15:24	2026-06-20 23:15:25
621	YWzH5tnFTk88D4vs3oCQw4cmKi1z1YzpWlyb3qNb	66.249.79.5	2026-06-21	[{"path":"\\/","time":"16:46"}]	2026-06-21 16:46:21	2026-06-21 16:46:22
624	o36BrLg12MEUPAL9AsebroK6yO2TE1pYRq5c0Xnf	66.249.79.4	2026-06-22	[{"path":"\\/order\\/vps","time":"13:24"}]	2026-06-22 13:24:58	2026-06-22 13:24:58
627	k2mEF2PKLR1L8NpKiCGDWWr2l9BcQBsrscbpnBEN	103.3.222.249	2026-06-23	[{"path":"\\/","time":"09:39"}]	2026-06-23 09:39:36	2026-06-23 09:39:36
633	cyWopzete9QYUWCVvXgC34pcaxiVSFrTm9OXofEs	114.10.99.91	2026-06-24	[{"path":"\\/","time":"10:56"}]	2026-06-24 10:56:46	2026-06-24 10:56:46
636	DCZRYJE4PGQfL4p5JN86q5WxeptNmo7hovPgIJe6	124.158.190.18	2026-06-25	[{"path":"\\/","time":"05:44"},{"path":"\\/saas-marketplace","time":"05:44"}]	2026-06-25 05:44:13	2026-06-25 05:44:59
639	Ghb7ziH8qblvTcXQzkKgOaSQVvSovamfXBqotIAK	114.10.77.47	2026-06-25	[{"path":"\\/","time":"09:16"}]	2026-06-25 09:16:23	2026-06-25 09:16:23
642	QmIx29hpQFPTKUMy8QTPtxkygZ4Ex1LhdP4TQQLD	66.249.71.129	2026-06-25	[{"path":"\\/","time":"22:14"}]	2026-06-25 22:14:40	2026-06-25 22:14:40
645	63f7bgBe8pUxG0tS2Rt9YsvXLKEXPGU9igd87Foh	66.249.79.7	2026-06-26	[{"path":"\\/","time":"10:02"}]	2026-06-26 10:02:54	2026-06-26 10:02:54
648	5Cqt2kUCuaNbxb96eXTh6xC8sgBIbhxJtVVZPM5c	114.79.4.179	2026-06-27	[{"path":"\\/","time":"02:18"}]	2026-06-27 02:18:42	2026-06-27 02:18:42
651	bXhHxjL71xeKJXyBcgoI7elkwjoK9RdkqOGIeh5r	66.249.79.37	2026-06-28	[{"path":"\\/","time":"01:58"}]	2026-06-28 01:58:16	2026-06-28 01:58:16
654	B9cmxOMJTOrEIHb8hW0mQbr4rW1pa4KBChyC1Va8	74.7.229.170	2026-06-28	[{"path":"\\/contact","time":"18:54"}]	2026-06-28 18:54:29	2026-06-28 18:54:29
657	hiBE2Ug2uxhujiip0q2Z1xDRb59nbR4aG0IzyAaQ	173.252.87.6	2026-06-29	[{"path":"\\/","time":"04:44"}]	2026-06-29 04:44:58	2026-06-29 04:44:58
660	zyapYuQT07jOelr2IdlYPLSffdn4dmLlBasMSyup	146.112.163.33	2026-06-29	[{"path":"\\/","time":"10:29"}]	2026-06-29 10:29:44	2026-06-29 10:29:44
663	6200PVlFb3369DukVIPgSVAhkYacLvwHWQxCBVmC	66.249.79.36	2026-06-30	[{"path":"\\/order\\/cpanel","time":"19:52"}]	2026-06-30 19:52:45	2026-06-30 19:52:45
666	K1zbcyucdFJyWQchhhud9PAQLzMmfRGqMpOAMMxG	135.232.20.17	2026-07-01	[{"path":"\\/services","time":"03:22"},{"path":"\\/","time":"03:22"}]	2026-07-01 03:22:01	2026-07-01 03:22:02
669	1Vc5uYo0af8ujuZleBRowR2bc5rLCbMbuTejk5w8	66.249.79.1	2026-07-01	[{"path":"\\/domain-registration","time":"22:32"}]	2026-07-01 22:32:19	2026-07-01 22:32:19
672	Efe6yVEzuvKwrRgSYO9Y0TT4vSKtzikqjiqBhrwD	66.249.79.7	2026-07-02	[{"path":"\\/","time":"13:44"}]	2026-07-02 13:44:12	2026-07-02 13:44:12
498	Va5BfK9A4FhmySglvhfKBdxNE4K75fbzEyjOJaI7	17.241.227.101	2026-06-03	[{"path":"\\/domain-registration","time":"06:53"}]	2026-06-03 06:53:07	2026-06-03 06:53:07
541	XNDtY9MTjG0fZPazfbtSc8in4ibXsZgRHay7c8nG	17.241.75.127	2026-06-05	[{"path":"\\/","time":"00:12"}]	2026-06-05 00:12:30	2026-06-05 00:12:30
545	o0X2JjT5lZOrMXHOGqT4DdOFfIowtMfeUoaH2KVO	71.6.235.28	2026-06-05	[{"path":"\\/","time":"08:22"}]	2026-06-05 08:22:50	2026-06-05 08:22:50
549	4xnDl4jCrsXCoKOVbezeLm16hFHzQEfKli9PLVjL	208.87.242.137	2026-06-05	[{"path":"\\/","time":"10:48"}]	2026-06-05 10:48:42	2026-06-05 10:48:42
553	bk1vl2ffOIelhlJuTt9ki4r6PVKUCh3Cfi37l7Ez	66.249.79.7	2026-06-06	[{"path":"\\/","time":"07:36"}]	2026-06-06 07:36:51	2026-06-06 07:36:51
557	nOFEyBQq0tHCxPs0iDkEoUZFSJejbA5klirC1GKp	103.18.35.95	2026-06-07	[{"path":"\\/","time":"15:58"}]	2026-06-07 15:58:31	2026-06-07 15:58:31
561	WO8QEBZpBWr7mcGEfiX1q4gNnlqUafPAM8G7x42n	45.126.58.149	2026-06-08	[{"path":"\\/","time":"13:41"}]	2026-06-08 13:41:00	2026-06-08 13:41:02
565	nzjS5wcfcznfhVn1EwgFQ8mCwVDI3Zmvvm0iXf0F	66.249.66.160	2026-06-09	[{"path":"\\/catalog","time":"21:41"}]	2026-06-09 21:41:17	2026-06-09 21:41:18
569	rG36IGIIL2BHQbkvuZ2b5f5yHK3pkUc4ii58TlVv	182.8.228.122	2026-06-10	[{"path":"\\/","time":"19:58"}]	2026-06-10 19:58:30	2026-06-10 19:58:30
573	nzjS5wcfcznfhVn1EwgFQ8mCwVDI3Zmvvm0iXf0F	66.249.71.129	2026-06-11	[{"path":"\\/","time":"00:09"}]	2026-06-11 00:09:31	2026-06-11 00:09:31
577	wRkxq44gmUBaxg0LkFmtTzapE3JZ4e1nL5bzJ2zX	149.56.160.185	2026-06-11	[{"path":"\\/","time":"07:13"}]	2026-06-11 07:13:02	2026-06-11 07:13:02
613	YWzH5tnFTk88D4vs3oCQw4cmKi1z1YzpWlyb3qNb	66.249.79.5	2026-06-19	[{"path":"\\/order\\/domain","time":"02:03"}]	2026-06-19 02:03:57	2026-06-19 02:03:57
580	vaPhL19kPQi1THIVxUVVfwYwU5rTBPbRNtEkzdnw	36.65.219.212	2026-06-11	[{"path":"\\/","time":"10:01"},{"path":"\\/register","time":"10:15"},{"path":"\\/","time":"10:27"}]	2026-06-11 10:01:47	2026-06-11 10:27:31
616	vZAPTYvxL6kKj0SZpTdv8ayuOz83kB3yE7jgKveX	66.249.79.4	2026-06-20	[{"path":"\\/vps-hosting","time":"01:59"}]	2026-06-20 01:59:25	2026-06-20 01:59:26
619	kScMBjQs0E7ZksEtvJvbw9z08jORL6yUkpSwTu7a	114.10.16.203	2026-06-21	[{"path":"\\/","time":"05:04"}]	2026-06-21 05:04:31	2026-06-21 05:04:32
586	K1se4iOmol3vdXV9RiM1ccWWmp9VunnEkR3rNLwM	66.249.79.7	2026-06-11	[{"path":"\\/saas\\/business-email","time":"16:06"},{"path":"\\/saas\\/fast-vpn","time":"16:06"}]	2026-06-11 16:06:26	2026-06-11 16:06:47
583	ALjJng1orzZmSQMftjaLedvwkFf1xSZpMdxXHHSB	103.145.68.51	2026-06-11	[{"path":"\\/saas-marketplace","time":"16:05"},{"path":"\\/saas\\/business-email","time":"16:06"},{"path":"\\/saas\\/fast-vpn","time":"16:06"},{"path":"\\/catalog","time":"16:07"},{"path":"\\/saas-marketplace","time":"16:07"}]	2026-06-11 16:05:41	2026-06-11 16:07:25
589	Wx6ki3ECljV6NieUxdezFZvAgsBybxcX4IbIbz0K	66.249.66.202	2026-06-12	[{"path":"\\/saas\\/fast-vpn","time":"20:27"}]	2026-06-12 20:27:09	2026-06-12 20:27:09
592	79KPFYExqhQmxDvjPnLms63MTrY8z2jPIjRLbDHZ	66.249.79.7	2026-06-13	[{"path":"\\/","time":"22:56"}]	2026-06-13 22:56:48	2026-06-13 22:56:48
595	GUnkGm6vvWNccEPVf6nCjcODpPrwy4oKCcWf5Afv	182.253.228.98	2026-06-16	[{"path":"\\/","time":"16:41"}]	2026-06-16 16:41:58	2026-06-16 16:41:58
598	BjWfO94d4jh6RTcV3LiNfbn1OrFffdTbifKOv66b	52.167.144.162	2026-06-17	[{"path":"\\/about-us","time":"01:33"}]	2026-06-17 01:33:48	2026-06-17 01:33:48
601	7NXWkltWWHlj3AcxyuRIUKHZl7iWwT9kkx6XVsfi	182.253.228.97	2026-06-17	[{"path":"\\/","time":"03:28"}]	2026-06-17 03:28:21	2026-06-17 03:28:21
604	2qSxPiDtKJTV3zdAHqFiX0N7ZgLb5XgoG8iLLfpA	182.253.150.2	2026-06-17	[{"path":"\\/","time":"07:07"}]	2026-06-17 07:07:22	2026-06-17 07:07:22
607	fSlikKR3FONaQSSvvtz89xznibhFWa0f7g3HGlVa	182.253.150.2	2026-06-17	[{"path":"\\/","time":"14:15"}]	2026-06-17 14:15:06	2026-06-17 14:15:07
610	obmSrWpPNVPDDEGcqe2S3K53z5vDDFYfHMDa7dJz	66.249.71.128	2026-06-18	[{"path":"\\/login","time":"09:20"}]	2026-06-18 09:20:11	2026-06-18 09:20:12
622	HJllOF4A5641Sag7D6vegP90a0ThkPq7Mw7Okgu6	66.249.79.4	2026-06-21	[{"path":"\\/","time":"18:00"}]	2026-06-21 18:00:49	2026-06-21 18:00:50
625	O8HpacQHCmss68pdvfExqrANsgH5pYE3qINYGKL3	66.249.79.36	2026-06-22	[{"path":"\\/about-us","time":"18:32"}]	2026-06-22 18:32:47	2026-06-22 18:32:47
628	2zoQytG3hBGwjwUmjFbV4C5t48J7RJYkwIfaUmw1	66.249.79.7	2026-06-23	[{"path":"\\/contact","time":"13:59"}]	2026-06-23 13:59:51	2026-06-23 13:59:51
631	1Fard1eZpT5EQhajEuII3tyg6trSmUZPh3l2QVsg	182.8.255.4	2026-06-24	[{"path":"\\/","time":"01:50"}]	2026-06-24 01:50:05	2026-06-24 01:50:05
634	DTFNZkJvmBK2EEUhHVNdqiPWloauJCgoc6xvtMj1	74.7.229.187	2026-06-24	[{"path":"\\/about-us","time":"19:53"}]	2026-06-24 19:53:36	2026-06-24 19:53:36
637	JcS6tUIN5tm2lSlLepmaJFqSfjrx1FclTIw9hVu7	66.249.79.37	2026-06-25	[{"path":"\\/domain-registration","time":"07:47"}]	2026-06-25 07:47:14	2026-06-25 07:47:14
640	cd08FU985tkDQ423ikfD8U8uMD8yT6ThGnsvUVrm	176.125.229.29	2026-06-25	[{"path":"\\/","time":"18:18"}]	2026-06-25 18:18:35	2026-06-25 18:18:35
643	bXhHxjL71xeKJXyBcgoI7elkwjoK9RdkqOGIeh5r	66.249.71.128	2026-06-26	[{"path":"\\/order\\/vps","time":"04:32"}]	2026-06-26 04:32:38	2026-06-26 04:32:38
646	QmIx29hpQFPTKUMy8QTPtxkygZ4Ex1LhdP4TQQLD	66.249.79.36	2026-06-26	[{"path":"\\/domain-registration","time":"19:36"}]	2026-06-26 19:36:05	2026-06-26 19:36:05
649	zJD88c85xWD3BiQWXwhwR3KBeyvfjpekpFNVUdv1	52.167.144.181	2026-06-27	[{"path":"\\/portfolio","time":"02:18"}]	2026-06-27 02:18:49	2026-06-27 02:18:49
652	m2TlN5e2eAKoaBaqQGkP2d1iVIb2df10Ubo3Do7z	74.7.228.185	2026-06-28	[{"path":"\\/","time":"09:41"}]	2026-06-28 09:41:28	2026-06-28 09:41:28
655	VyMu3tODKSan4NT3NWZaQT5lzC9qOgBNMXLgpsBs	182.253.228.98	2026-06-28	[{"path":"\\/","time":"19:21"}]	2026-06-28 19:21:44	2026-06-28 19:21:44
658	QMo1Z4hghrxFDLuxO5g5UkBFdDwkHR97NCwXBOK9	173.252.87.3	2026-06-29	[{"path":"\\/","time":"04:44"}]	2026-06-29 04:44:59	2026-06-29 04:44:59
661	aNITUs96kzZaLQx9WnjL3cKPqKOim1o0rN0jloDJ	52.167.144.183	2026-06-30	[{"path":"\\/cpanel-hosting","time":"06:52"}]	2026-06-30 06:52:02	2026-06-30 06:52:02
664	yyFkw3Yv6znycrl0JFdLtYTIQt9lAUoZ4DcDf2mh	52.167.144.198	2026-06-30	[{"path":"\\/","time":"21:31"}]	2026-06-30 21:31:23	2026-06-30 21:31:23
667	hid4FQioB3IAcWGkwHV4ING8FETcDz7kO38IjZlv	66.249.71.129	2026-07-01	[{"path":"\\/login","time":"04:46"}]	2026-07-01 04:46:48	2026-07-01 04:46:48
670	6EhYTpZiOQdK721IP2a1Ga5BPIJfMkl6Fuu3W3Xz	40.77.167.30	2026-07-02	[{"path":"\\/about-us","time":"06:27"}]	2026-07-02 06:27:07	2026-07-02 06:27:07
673	f5dA3qragL39cIGSOCc9V22nFDEXjTpHczgupqhn	66.249.79.1	2026-07-02	[{"path":"\\/contact","time":"22:53"}]	2026-07-02 22:53:36	2026-07-02 22:53:36
675	UeCxvNZYPuiaL2f62eRofyDEsGg3vkMrObg6mIkN	66.249.79.37	2026-07-03	[{"path":"\\/","time":"03:18"}]	2026-07-03 03:18:40	2026-07-03 03:18:40
677	ibrwQagu98vEyiNgDaldWQ5zzErrksAU0e6H71XS	66.249.79.8	2026-07-03	[{"path":"\\/","time":"10:15"}]	2026-07-03 10:15:43	2026-07-03 10:15:43
679	xjNANP0ifAkfdjlGBRh6KNoxvPG4EFU9niv5O9sW	66.249.79.1	2026-07-03	[{"path":"\\/login","time":"17:37"}]	2026-07-03 17:37:12	2026-07-03 17:37:12
681	RnkgogvkPzyxzTcv8jxikMapouvKyZB70mW1g82V	64.237.59.42	2026-07-04	[{"path":"\\/","time":"06:17"}]	2026-07-04 06:17:07	2026-07-04 06:17:07
683	fzbSjdCeqvnpAt3v9wLS9sICNxem4YaA03SJ0Mjf	66.249.79.32	2026-07-06	[{"path":"\\/register","time":"10:57"}]	2026-07-06 10:57:42	2026-07-06 10:57:42
685	L09YKLSF3YSeOnDBuIQ75KUfpa26zxtzWujnLgCF	40.77.167.116	2026-07-07	[{"path":"\\/login","time":"05:48"}]	2026-07-07 05:48:19	2026-07-07 05:48:19
499	1Dm06MlA7gsWd3dxzDiuCOXQhHgXexkuLoW2NFAk	3.81.211.44	2026-06-03	[{"path":"\\/notifications","time":"06:54"}]	2026-06-03 06:54:20	2026-06-03 06:54:20
542	1wwgVViHlmsnaxRm1YkFOGBhJ2yNzw9LoINTlyog	71.6.238.136	2026-06-05	[{"path":"\\/","time":"04:21"}]	2026-06-05 04:21:26	2026-06-05 04:21:26
546	QJoKshzaH0pdIrNEzw7EXXvuJr4Av1F5jpVhEjwu	172.104.146.193	2026-06-05	[{"path":"\\/","time":"09:54"}]	2026-06-05 09:54:18	2026-06-05 09:54:18
550	anZvKK9TXWg7rij1Xr97HjXfFKhPqRuYs5q7tjsJ	66.249.66.32	2026-06-05	[{"path":"\\/domain-registration","time":"15:38"}]	2026-06-05 15:38:01	2026-06-05 15:38:01
554	FHCV5GFBLT7b4fWFYyE9ga8sxqkPBkJ5t7LLuHoq	52.167.144.21	2026-06-06	[{"path":"\\/vps-hosting","time":"22:48"}]	2026-06-06 22:48:31	2026-06-06 22:48:32
558	UelhDoPZNlu1SgD4NiyHGixLU2PpR8TE8YdnNcqq	182.8.228.110	2026-06-07	[{"path":"\\/","time":"18:41"}]	2026-06-07 18:41:17	2026-06-07 18:41:17
562	X4ZkojTlL9ihVc1WMMfItkHqAsty5MsDtJl03qWl	205.169.39.17	2026-06-08	[{"path":"\\/","time":"15:04"}]	2026-06-08 15:04:17	2026-06-08 15:04:18
566	OyPiC7NpluS5kXV75Q4mYT8cPEYX0gk8zh9ErMcL	182.8.228.122	2026-06-10	[{"path":"\\/","time":"13:45"}]	2026-06-10 13:45:53	2026-06-10 13:45:53
570	K1se4iOmol3vdXV9RiM1ccWWmp9VunnEkR3rNLwM	66.249.79.7	2026-06-10	[{"path":"\\/","time":"20:48"}]	2026-06-10 20:48:04	2026-06-10 20:48:04
574	6gfzc5OEPJMvRmXS4wneKKJcDESwdOx2lNyqW1Ng	66.249.68.67	2026-06-11	[{"path":"\\/","time":"00:27"}]	2026-06-11 00:27:14	2026-06-11 00:27:14
578	230nhmGCv4JwR4VNZj3WR8zY8CFt4CphKktvWBsi	36.65.219.212	2026-06-11	[{"path":"\\/","time":"08:35"}]	2026-06-11 08:35:33	2026-06-11 08:35:34
581	o4zHPuTr5b6ojkfrCjVoFCOrB0jTfNLauVQg9cYy	207.46.13.102	2026-06-11	[{"path":"\\/about-us","time":"12:21"}]	2026-06-11 12:21:14	2026-06-11 12:21:16
584	ngKAsfp6f8FdrqTSC69hgFidL9u7U6RjX8xpOX2r	66.249.79.8	2026-06-11	[{"path":"\\/saas-marketplace","time":"16:05"}]	2026-06-11 16:05:53	2026-06-11 16:05:53
587	oUCBwYiVvsneHo3iLcEzTYWlnO9LHn0yz4qT7hbZ	66.249.79.7	2026-06-11	[{"path":"\\/saas\\/fast-vpn","time":"16:06"}]	2026-06-11 16:06:45	2026-06-11 16:06:45
590	4b021jYPsfaNqrRkdLOYwI2fk7ZEHdCd66BH694O	66.249.71.128	2026-06-13	[{"path":"\\/catalog","time":"06:28"}]	2026-06-13 06:28:53	2026-06-13 06:28:53
629	o36BrLg12MEUPAL9AsebroK6yO2TE1pYRq5c0Xnf	66.249.79.8	2026-06-23	[{"path":"\\/saas-marketplace","time":"16:33"}]	2026-06-23 16:33:44	2026-06-23 16:33:44
593	lHzG2bSfU2ifxJC6Ml2qKgjdlZE8oNbwSzS5CLHd	103.46.8.35	2026-06-15	[{"path":"\\/","time":"05:27"},{"path":"\\/catalog","time":"05:27"}]	2026-06-15 05:27:04	2026-06-15 05:27:47
596	72tQI3b20yrz3FgcxHIIdKfLMJtO6bRjLcCEwBBl	66.249.71.128	2026-06-16	[{"path":"\\/","time":"20:40"}]	2026-06-16 20:40:40	2026-06-16 20:40:40
599	yziPRGSpGYhzV9wp5K29Qh7WRgRjP4CRf7HqRUMT	66.249.79.4	2026-06-17	[{"path":"\\/contact","time":"02:16"}]	2026-06-17 02:16:31	2026-06-17 02:16:31
602	Odj5IwHW8rTBJBNbdynfIbv8B5AnFXOjptAFu8Ta	114.10.6.47	2026-06-17	[{"path":"\\/","time":"03:32"}]	2026-06-17 03:32:20	2026-06-17 03:32:20
605	LraGo6UV0Kb1YA4ru0pZLzIlcDzCwO170CoK4Jrc	140.213.21.210	2026-06-17	[{"path":"\\/","time":"07:08"}]	2026-06-17 07:08:24	2026-06-17 07:08:24
608	5vS4kfRKYMEcbRdulfNjHYQYA7gbqiabUkLXs1Ah	66.249.79.32	2026-06-17	[{"path":"\\/domain-registration","time":"14:15"}]	2026-06-17 14:15:17	2026-06-17 14:15:17
611	BgX6hz6HcZ2SeCkfB7fcOEjRuNQBWHelF28h5MFG	66.249.79.36	2026-06-18	[{"path":"\\/","time":"15:18"}]	2026-06-18 15:18:43	2026-06-18 15:18:44
614	BjWfO94d4jh6RTcV3LiNfbn1OrFffdTbifKOv66b	65.55.210.117	2026-06-19	[{"path":"\\/","time":"08:31"}]	2026-06-19 08:31:04	2026-06-19 08:31:10
617	A2IqnUDUgM1VN45JCa8ephHtW7ZlsDPZncDbHH87	66.249.79.5	2026-06-20	[{"path":"\\/","time":"04:34"}]	2026-06-20 04:34:48	2026-06-20 04:34:48
620	UadhtReuwBJC7WIXVS398mEueCpgp81iDuMFBBp2	66.249.79.5	2026-06-21	[{"path":"\\/","time":"16:45"}]	2026-06-21 16:45:44	2026-06-21 16:45:44
623	WU7RCYREny0PjJUFiRiOZUitsrNABqHKRTERj9jw	66.249.79.5	2026-06-22	[{"path":"\\/order\\/cpanel","time":"11:50"}]	2026-06-22 11:50:54	2026-06-22 11:50:54
626	cPatLoN8jcIKxlx8eOCTxc5LjWEBmQ9BcxPUsAxL	17.246.15.92	2026-06-22	[{"path":"\\/catalog","time":"23:59"}]	2026-06-22 23:59:26	2026-06-22 23:59:26
632	jr8BhHvcVfTBqREUMWx4X87WY0GHryUmHVO1L8h7	74.7.243.56	2026-06-24	[{"path":"\\/vps-hosting","time":"08:02"}]	2026-06-24 08:02:39	2026-06-24 08:02:39
635	4geqBtUOWhparDuebrcCHKX5iSqnNY88TqynBg5b	182.253.228.96	2026-06-25	[{"path":"\\/","time":"05:09"}]	2026-06-25 05:09:38	2026-06-25 05:09:38
638	FLQfiHRZcSQncUldZm1YMx4NH9QUGYTyiKRAYbqT	182.253.228.96	2026-06-25	[{"path":"\\/","time":"08:57"}]	2026-06-25 08:57:09	2026-06-25 08:57:09
641	xgEUUKOxDrPsQWorKEA0CcyS7CLxOKCw6uNHkE7Y	149.22.95.135	2026-06-25	[{"path":"\\/","time":"19:40"}]	2026-06-25 19:40:02	2026-06-25 19:40:02
644	xTiLzU4TfAIaqMatib2aZB1t30y5NM8abGik8D2c	66.249.79.8	2026-06-26	[{"path":"\\/domain-registration","time":"09:52"}]	2026-06-26 09:52:48	2026-06-26 09:52:48
647	yFBZietRYaCF7v8szmIozntb08DpFhByELg9aG0i	66.249.79.7	2026-06-27	[{"path":"\\/domain-registration","time":"01:00"}]	2026-06-27 01:00:38	2026-06-27 01:00:38
650	QKCsZus5vpcXEww3BbzTi0W7aZMNiu03PJKEykNZ	182.253.150.2	2026-06-27	[{"path":"\\/","time":"11:36"}]	2026-06-27 11:36:58	2026-06-27 11:36:58
653	WBccLhbqIUII2p32ocSLLqNhwLRoEmG8n8w2zgPK	66.249.79.7	2026-06-28	[{"path":"\\/","time":"16:34"}]	2026-06-28 16:34:37	2026-06-28 16:34:37
656	pB4fBTwRLZerHgjVUR2uZsGhkFSG6ZZQXA05Tjzq	103.147.8.117	2026-06-29	[{"path":"\\/","time":"03:28"}]	2026-06-29 03:28:53	2026-06-29 03:28:53
659	i8lDXsxWztPWmbROu4U9C0niGbJlQCxYstiANPGO	182.253.150.0	2026-06-29	[{"path":"\\/","time":"09:06"}]	2026-06-29 09:06:57	2026-06-29 09:06:57
662	1Vc5uYo0af8ujuZleBRowR2bc5rLCbMbuTejk5w8	66.249.79.8	2026-06-30	[{"path":"\\/","time":"15:30"}]	2026-06-30 15:30:49	2026-06-30 15:30:49
665	CUNsllZ1WzomTjc1WtMQ046r2tbPxyAvUWNMasR2	135.232.20.17	2026-07-01	[{"path":"\\/","time":"03:21"}]	2026-07-01 03:21:27	2026-07-01 03:21:27
668	Efe6yVEzuvKwrRgSYO9Y0TT4vSKtzikqjiqBhrwD	66.249.79.8	2026-07-01	[{"path":"\\/domain-registration","time":"22:31"}]	2026-07-01 22:31:34	2026-07-01 22:31:34
671	rRYgoOReAx3pCPgswK7hx174R2cUnr2ckgUQHuv4	66.249.79.37	2026-07-02	[{"path":"\\/register","time":"07:18"}]	2026-07-02 07:18:13	2026-07-02 07:18:13
674	sG975jfX5hAldkRYpZQAplSnbHRPMTF0lU0VsL1v	66.249.79.37	2026-07-03	[{"path":"\\/","time":"03:18"}]	2026-07-03 03:18:20	2026-07-03 03:18:20
676	4pQZKDS1Hss20GNqAYH8WscWpwkoVtWe3lpLHJtI	66.249.71.129	2026-07-03	[{"path":"\\/","time":"07:54"}]	2026-07-03 07:54:40	2026-07-03 07:54:40
678	WMyU5Z9FwLBfFOkfiyLNzut120KbOSLvot9Rnkp6	66.249.79.7	2026-07-03	[{"path":"\\/domain-registration","time":"12:41"},{"path":"\\/vps-hosting","time":"20:07"}]	2026-07-03 12:41:18	2026-07-03 20:07:59
680	ifNB5n1iwxgJLXPmW5oqlomcUFmKGUgotyfKBN68	66.249.79.37	2026-07-03	[{"path":"\\/login","time":"22:10"}]	2026-07-03 22:10:54	2026-07-03 22:10:54
682	fQLksylFbnqUHpTeVJLlutfKEntLT7vu6TZNKtsr	66.249.79.1	2026-07-05	[{"path":"\\/domain-registration","time":"22:26"}]	2026-07-05 22:26:02	2026-07-05 22:26:02
684	h2Yj7CWdlR1HOx6kaLsUkGZ855bp0d4WJ9IwPuXm	66.249.79.8	2026-07-06	[{"path":"\\/","time":"10:58"}]	2026-07-06 10:58:51	2026-07-06 10:58:51
686	PeeylfIJkJUqDJrxdKgslfZINyKqXiMZGZK7of1I	40.77.177.170	2026-07-07	[{"path":"\\/about-us","time":"06:57"}]	2026-07-07 06:57:36	2026-07-07 06:57:36
687	imp1mFMMsZR0BlnzenvtxuNci6zqky4WcthEcB9C	202.8.41.126	2026-07-07	[{"path":"\\/","time":"11:41"}]	2026-07-07 11:41:24	2026-07-07 11:41:24
688	DBTPaoFUWRfhVy7OP9O2f5XRlH6UcU6j6vuLHz7b	66.249.71.129	2026-07-07	[{"path":"\\/","time":"13:28"}]	2026-07-07 13:28:01	2026-07-07 13:28:01
506	Y2tzaDR5x1HapFePnnYArfk4zBLL98k4352OiG2g	32.194.87.130	2026-06-03	[{"path":"\\/saas\\/fast-vpn","time":"06:59"}]	2026-06-03 06:59:15	2026-06-03 06:59:16
500	jSndIzvoxXUlRUw7zqga0eamyO7GKiP6zj5bNkHy	107.23.8.235	2026-06-03	[{"path":"\\/faq","time":"06:56"}]	2026-06-03 06:56:04	2026-06-03 06:56:04
511	0mozTtDVdBhXTvFTnRVP1ndkQSvFi41G4WT56dYh	40.77.179.131	2026-06-03	[{"path":"\\/","time":"07:10"}]	2026-06-03 07:10:37	2026-06-03 07:10:37
502	bEZD9NVd4FEwjnXk1k6mH3owrGj5EhcACUPLyIfI	52.204.167.225	2026-06-03	[{"path":"\\/saas-marketplace","time":"06:57"}]	2026-06-03 06:57:20	2026-06-03 06:57:20
501	0aNfpDmeOvtkcAKdIVfTNFbuuRNMp6gZ1xRtIAel	35.174.11.4	2026-06-03	[{"path":"\\/saas\\/business-email","time":"06:57"}]	2026-06-03 06:57:20	2026-06-03 06:57:20
503	G3SMD6Ep2fJ5oLJxtnVvIVrIbyhVig6NUrSLsvyw	54.80.182.194	2026-06-03	[{"path":"\\/client-area\\/invoices","time":"06:57"}]	2026-06-03 06:57:53	2026-06-03 06:57:53
504	QkODY6pbOUWsMONVK0JF5i4PTGQa5860lTNRbRMl	54.236.14.188	2026-06-03	[{"path":"\\/contact","time":"06:58"}]	2026-06-03 06:58:28	2026-06-03 06:58:28
505	pJJmLOU0ae695jSEeJJTPFGvZUiPDvqSrmE8PboQ	34.207.136.164	2026-06-03	[{"path":"\\/about-us","time":"06:58"}]	2026-06-03 06:58:36	2026-06-03 06:58:36
507	1hCvrxdLbGvOOrVPck6owZYInUioJEizJyiYnTEV	34.230.52.231	2026-06-03	[{"path":"\\/client-area\\/profile","time":"07:00"}]	2026-06-03 07:00:21	2026-06-03 07:00:21
508	LPr3rI4Oadtwv26YVbxIeAlxK7yES60WfGla7F1o	3.81.211.44	2026-06-03	[{"path":"\\/join-partner","time":"07:01"}]	2026-06-03 07:01:21	2026-06-03 07:01:21
509	nxtSpPrmdCPLCoZout7ByWIVAB4EAcY0vVej8XLJ	18.212.153.209	2026-06-03	[{"path":"\\/client-area\\/saas","time":"07:01"}]	2026-06-03 07:01:22	2026-06-03 07:01:23
510	D5alSaxh7omZ3zfl8irF0zdSa7AqPIAbEhPgqhU7	54.209.248.184	2026-06-03	[{"path":"\\/profile","time":"07:02"}]	2026-06-03 07:02:01	2026-06-03 07:02:01
525	z2VceXFQvquMl6bii26y1g4q01v6ZbGXTd2nCb1J	114.122.82.239	2026-06-03	[{"path":"\\/domain-registration","time":"08:09"},{"path":"\\/about-us","time":"08:20"},{"path":"\\/portfolio","time":"08:25"},{"path":"\\/catalog","time":"08:31"}]	2026-06-03 08:09:15	2026-06-03 08:31:17
484	ZsWKA5KnUTAoHu4o78MGFzNnleFPTaLtakawCds1	103.141.61.140	2026-06-03	[{"path":"\\/","time":"06:22"},{"path":"\\/contact","time":"06:22"},{"path":"\\/catalog","time":"06:35"},{"path":"\\/domain-registration","time":"06:35"},{"path":"\\/services","time":"06:35"},{"path":"\\/portfolio","time":"06:35"},{"path":"\\/about-us","time":"06:36"},{"path":"\\/","time":"06:37"},{"path":"\\/services","time":"06:37"},{"path":"\\/","time":"06:37"},{"path":"\\/cart","time":"06:37"},{"path":"\\/catalog","time":"06:37"},{"path":"\\/domain-registration","time":"06:37"},{"path":"\\/order\\/domain","time":"06:38"},{"path":"\\/cart","time":"06:38"},{"path":"\\/order\\/domain","time":"06:39"},{"path":"\\/cart","time":"06:39"},{"path":"\\/checkout","time":"06:40"},{"path":"\\/order\\/instruction\\/12","time":"06:40"},{"path":"\\/client-area\\/invoices","time":"06:48"},{"path":"\\/catalog","time":"06:48"},{"path":"\\/cart","time":"06:48"},{"path":"\\/catalog","time":"06:48"},{"path":"\\/domain-registration","time":"06:49"},{"path":"\\/order\\/domain","time":"06:49"},{"path":"\\/cart","time":"06:49"},{"path":"\\/checkout","time":"06:49"},{"path":"\\/order\\/instruction\\/13","time":"06:50"},{"path":"\\/notifications","time":"06:50"},{"path":"\\/","time":"06:50"},{"path":"\\/contact","time":"06:50"},{"path":"\\/services","time":"06:50"},{"path":"\\/about-us","time":"06:51"},{"path":"\\/faq","time":"06:52"},{"path":"\\/catalog","time":"06:52"},{"path":"\\/saas-marketplace","time":"06:52"},{"path":"\\/saas\\/fast-vpn","time":"06:52"},{"path":"\\/cart","time":"06:53"},{"path":"\\/saas\\/business-email","time":"06:53"},{"path":"\\/join-partner","time":"06:53"},{"path":"\\/profile","time":"06:54"},{"path":"\\/client-area\\/profile","time":"06:54"},{"path":"\\/client-area\\/invoices","time":"06:55"},{"path":"\\/client-area\\/saas","time":"06:55"},{"path":"\\/client-area\\/invoices","time":"06:55"},{"path":"\\/client-area\\/saas","time":"06:56"},{"path":"\\/client-area","time":"06:56"},{"path":"\\/cart","time":"07:06"},{"path":"\\/checkout","time":"07:06"},{"path":"\\/order\\/instruction\\/14","time":"07:07"}]	2026-06-03 06:22:04	2026-06-03 07:07:02
513	fKVtkfQVPRZYfAwL6MHdOsLT4qoFSKw1Nq4KjqGO	54.242.178.65	2026-06-03	[{"path":"\\/order\\/instruction\\/14","time":"07:16"}]	2026-06-03 07:16:45	2026-06-03 07:16:45
512	apFuBdx636CLYAcEfDwyykKF69kMibNTU8wielHb	103.147.8.130	2026-06-03	[{"path":"\\/","time":"07:16"},{"path":"\\/login","time":"07:18"}]	2026-06-03 07:16:26	2026-06-03 07:18:58
514	OqxkIc0TOYHEtrfcilHQ8ZIr2nAGv52QCHukbysc	103.147.8.130	2026-06-03	[{"path":"\\/login","time":"07:19"}]	2026-06-03 07:19:58	2026-06-03 07:19:58
519	qczLast0EXhQjGFiXcKKSGha3wvdH1WfkNAogsYT	103.141.61.140	2026-06-03	[{"path":"\\/","time":"07:41"},{"path":"\\/register","time":"07:43"},{"path":"\\/","time":"07:53"},{"path":"\\/register","time":"07:53"}]	2026-06-03 07:41:31	2026-06-03 07:53:52
515	i2Cg1drdYSq4Tsv5nuUabfjTFjmMpK7mBBFaftN3	103.147.8.130	2026-06-03	[{"path":"\\/","time":"07:20"},{"path":"\\/profile","time":"07:20"}]	2026-06-03 07:20:34	2026-06-03 07:20:46
516	aNQs1QAhKwuTx4M2HBSTaUC39uWJ4sXcVI4R8Vxc	103.147.8.130	2026-06-03	[{"path":"\\/","time":"07:21"},{"path":"\\/login","time":"07:21"},{"path":"\\/register","time":"07:21"}]	2026-06-03 07:21:14	2026-06-03 07:21:21
520	WEx6Geq3z2jLzcfyAQ5D4U0AeyLFYQB7iaRrEgYS	114.122.82.239	2026-06-03	[{"path":"\\/","time":"07:48"},{"path":"\\/register","time":"07:48"},{"path":"\\/login","time":"08:06"}]	2026-06-03 07:48:24	2026-06-03 08:06:21
521	5qrNccyhMb48nlukVyzg0o5mfvKnSym063EMgg46	114.122.82.239	2026-06-03	[{"path":"\\/login","time":"07:54"},{"path":"\\/forgot-password","time":"07:54"},{"path":"\\/login","time":"07:54"}]	2026-06-03 07:54:19	2026-06-03 07:54:41
522	KBVRbqyh3XX2HSwFU5JcgACkXLSieTrrppEW8eEG	114.122.82.239	2026-06-03	[{"path":"\\/","time":"07:55"},{"path":"\\/profile","time":"07:55"}]	2026-06-03 07:55:32	2026-06-03 07:55:49
517	se0I8wJbMKkp6eDYl1qfvpV17kUDojsPkj5QiD4y	103.147.8.130	2026-06-03	[{"path":"\\/","time":"07:24"},{"path":"\\/catalog","time":"07:26"},{"path":"\\/domain-registration","time":"07:26"},{"path":"\\/order\\/domain","time":"07:28"},{"path":"\\/","time":"07:38"},{"path":"\\/catalog","time":"07:39"}]	2026-06-03 07:24:36	2026-06-03 07:39:51
518	6fsLaMpwylrKzkx85ll7f5BNIJfEJ7AYzVVhhXqN	103.147.8.130	2026-06-03	[{"path":"\\/catalog","time":"07:40"}]	2026-06-03 07:40:43	2026-06-03 07:40:43
530	CSwFOrqHOQkUxOec8xKQKcXdXIZug9LLgDhF5QOk	17.241.227.253	2026-06-03	[{"path":"\\/domain-registration","time":"20:05"}]	2026-06-03 20:05:12	2026-06-03 20:05:13
531	dYkGTmAAMq3TyjllIn3aMOhXwSiuIWzw0V78ojgY	66.249.79.7	2026-06-03	[{"path":"\\/portfolio","time":"21:51"}]	2026-06-03 21:51:27	2026-06-03 21:51:27
523	Ma0Bo0WpZrysG1YKYdPaV46aSq2tu5gHfB24eB8r	114.122.82.239	2026-06-03	[{"path":"\\/login","time":"07:56"},{"path":"\\/forgot-password","time":"07:56"}]	2026-06-03 07:56:43	2026-06-03 07:56:54
526	XJ1BcyvGkhaR8DyYnNx9l20u7PIMVnlVsEbXv9Hw	103.147.8.130	2026-06-03	[{"path":"\\/terms","time":"10:43"},{"path":"\\/","time":"10:45"},{"path":"\\/login","time":"10:45"}]	2026-06-03 10:43:43	2026-06-03 10:45:26
527	HWjTbNfC54b0bsBBrC4uP52EDr1Th6Ltq3CWWm6i	103.147.8.130	2026-06-03	[{"path":"\\/","time":"10:51"}]	2026-06-03 10:51:46	2026-06-03 10:51:46
528	OLOVppWrzKfdd7nWI6Z3OJDur5jGhJQUdCvbpPgR	66.249.66.202	2026-06-03	[{"path":"\\/catalog","time":"12:29"}]	2026-06-03 12:29:33	2026-06-03 12:29:33
529	i5bFAG3vkD9X9Zx2fgpg5WPKTexKEvAYXYZYhV3U	103.147.8.130	2026-06-03	[{"path":"\\/","time":"13:36"},{"path":"\\/contact","time":"13:36"},{"path":"\\/about-us","time":"13:37"},{"path":"\\/services","time":"13:37"},{"path":"\\/faq","time":"13:38"},{"path":"\\/","time":"13:38"},{"path":"\\/services","time":"13:46"}]	2026-06-03 13:36:20	2026-06-03 13:46:19
532	McdIjCau9wdVjhP8WGytXxiPNRVEr22tru5s2bum	17.22.253.11	2026-06-03	[{"path":"\\/portfolio","time":"23:20"}]	2026-06-03 23:20:20	2026-06-03 23:20:20
533	RXWcJTWMFDj9L1UbAb9j8tp6upJl0Gw7I96VMGGX	66.249.79.7	2026-06-04	[{"path":"\\/vps-hosting","time":"00:07"}]	2026-06-04 00:07:33	2026-06-04 00:07:33
534	E1Uiwb6AxfhMO5hJD4MqWUXdNzyaJIhdTdhJzIbG	66.249.79.8	2026-06-04	[{"path":"\\/","time":"02:37"}]	2026-06-04 02:37:24	2026-06-04 02:37:24
535	xSY3oz1ssxfhgRASRnRUFngsRCFGdPSDvOWb0xFA	66.249.66.75	2026-06-04	[{"path":"\\/portfolio","time":"03:01"}]	2026-06-04 03:01:20	2026-06-04 03:01:21
536	qPNdDlbhWM0KEZiVAspsWO28XRgEkB1Tq4I3zV73	103.147.8.130	2026-06-04	[{"path":"\\/catalog","time":"04:36"}]	2026-06-04 04:36:52	2026-06-04 04:36:53
537	RdC1dfEAHxT76Tvi9daGHENpsHG9DFJHNLev9fcx	66.249.79.1	2026-06-04	[{"path":"\\/saas-marketplace","time":"14:41"}]	2026-06-04 14:41:24	2026-06-04 14:41:24
538	UfV9hZBIexSgZEWAfw2ooY1p8SV16CPhDlvlQZ71	66.249.68.68	2026-06-04	[{"path":"\\/","time":"18:00"}]	2026-06-04 18:00:22	2026-06-04 18:00:22
539	Tn9MbKRBqEIaIJxFyENSCLopHj2iRmzdLokPcPhC	66.249.79.202	2026-06-04	[{"path":"\\/","time":"20:33"}]	2026-06-04 20:33:48	2026-06-04 20:33:48
540	cKmMv8DQ1T85KPzjP27w6BcuCMsdpac4dYFevSph	66.249.79.8	2026-06-04	[{"path":"\\/forgot-password","time":"22:59"}]	2026-06-04 22:59:58	2026-06-04 22:59:58
689	Zjy4ymXozKPThGfPZVWueKaI2l3OQ3NAhKtiv35u	182.253.228.98	2026-07-08	[{"path":"\\/","time":"02:14"}]	2026-07-08 02:14:54	2026-07-08 02:14:54
690	F0Yals19MdLQ7bwb3vyTkTDRxOi7StbgC7tQTC2N	173.252.87.115	2026-07-08	[{"path":"\\/","time":"04:06"}]	2026-07-08 04:06:42	2026-07-08 04:06:42
691	KxhLWkzqxm5jAqQMM3xDWO8i6Z3v5PgcUFFsRKCj	114.10.120.81	2026-07-08	[{"path":"\\/","time":"04:08"}]	2026-07-08 04:08:36	2026-07-08 04:08:36
692	yrZRaous0Zjawq40j6gkXzQiYTigirtH0QBOX0at	125.161.54.73	2026-07-08	[{"path":"\\/","time":"07:44"}]	2026-07-08 07:44:23	2026-07-08 07:44:23
693	6vioZGZ6RanVYAonXMLWDJ36EskTa6gaMaOfawZT	17.241.227.220	2026-07-08	[{"path":"\\/vps-hosting","time":"10:54"}]	2026-07-08 10:54:15	2026-07-08 10:54:15
694	XYOIzMzGdEO4ZBshhdiJPuGSha9teW2FGZPh6EoC	17.241.227.174	2026-07-09	[{"path":"\\/forgot-password","time":"08:12"}]	2026-07-09 08:12:12	2026-07-09 08:12:12
700	9NTmJd8v4e8HulniXSgHssh8onTPbpwaTAHhHivv	182.253.228.96	2026-07-10	[{"path":"\\/","time":"06:19"},{"path":"\\/login","time":"06:19"},{"path":"\\/","time":"06:44"},{"path":"\\/login","time":"06:44"}]	2026-07-10 06:19:42	2026-07-10 06:44:24
710	AXheXOjQwh5d6AfRs990ENKwxQfNJZRcu8IufBK1	103.147.8.19	2026-07-10	[{"path":"\\/","time":"12:30"},{"path":"\\/client-area","time":"12:30"},{"path":"\\/client-area\\/saas","time":"12:30"},{"path":"\\/client-area\\/vps","time":"12:30"},{"path":"\\/client-area\\/hosting","time":"12:30"},{"path":"\\/client-area\\/invoices","time":"12:30"},{"path":"\\/client-area","time":"12:31"},{"path":"\\/catalog","time":"12:58"},{"path":"\\/order\\/cpanel","time":"12:58"},{"path":"\\/domain-registration","time":"12:58"},{"path":"\\/order\\/domain","time":"12:59"},{"path":"\\/cart","time":"12:59"},{"path":"\\/checkout","time":"12:59"},{"path":"\\/order\\/instruction\\/18","time":"12:59"},{"path":"\\/cart","time":"13:31"},{"path":"\\/checkout","time":"13:31"},{"path":"\\/order\\/instruction\\/19","time":"13:31"},{"path":"\\/","time":"14:20"},{"path":"\\/catalog","time":"14:20"},{"path":"\\/saas-marketplace","time":"14:21"},{"path":"\\/saas\\/chatbot-plugin","time":"14:26"},{"path":"\\/cart","time":"14:26"},{"path":"\\/checkout","time":"14:27"},{"path":"\\/order\\/instruction\\/20","time":"14:27"},{"path":"\\/client-area\\/invoices","time":"14:29"},{"path":"\\/client-area\\/plugin","time":"14:30"}]	2026-07-10 12:30:48	2026-07-10 14:30:10
695	ipc4hGwKATr0SuCLhYDhXeZyavta2eejzHqX7z9Z	202.165.42.242	2026-07-09	[{"path":"\\/","time":"08:51"},{"path":"\\/contact","time":"08:51"},{"path":"\\/catalog","time":"08:51"},{"path":"\\/","time":"08:52"}]	2026-07-09 08:51:38	2026-07-09 08:52:08
696	SAfEMKY1Emp7SLLzZjRTuhLMKIC93K2Hp5yGVcmW	66.249.79.37	2026-07-09	[{"path":"\\/","time":"11:08"}]	2026-07-09 11:08:59	2026-07-09 11:08:59
697	IK9aSCbBX35TkW9UXd4C5Sc4uojPsyesSqWCvJQj	66.249.79.36	2026-07-09	[{"path":"\\/","time":"11:08"}]	2026-07-09 11:08:59	2026-07-09 11:08:59
698	e8yZ6ULwjVfrP7bTgXHUhsL39HUpuglbGpUxuh7f	157.55.39.10	2026-07-09	[{"path":"\\/vps-hosting","time":"14:34"}]	2026-07-09 14:34:29	2026-07-09 14:34:29
699	XvKfRxzANKlwUQIeQucLWFDoVsmd6qvL22b88vsO	38.49.216.84	2026-07-09	[{"path":"\\/","time":"16:26"}]	2026-07-09 16:26:46	2026-07-09 16:26:46
705	xO2K0joPHWkTE1C9j4ahQW8IfjHnU0tet3LsB2ru	103.141.61.140	2026-07-10	[{"path":"\\/admin\\/dashboard","time":"06:58"}]	2026-07-10 06:58:52	2026-07-10 06:58:52
704	WZOlRB5N3B8fsB7TQubwQ4BXacfe4p987V3uwBaK	182.253.228.96	2026-07-10	[{"path":"\\/admin\\/dashboard","time":"06:44"},{"path":"\\/","time":"07:48"}]	2026-07-10 06:44:55	2026-07-10 07:48:39
701	3jT3wqHd1LlNSnKXE3JR7eyGaTrmFiCoNMBUxLC0	103.141.61.140	2026-07-10	[{"path":"\\/","time":"06:40"},{"path":"\\/login","time":"06:40"}]	2026-07-10 06:40:35	2026-07-10 06:40:41
702	izLlmUaOXQpLG1snXH0P4pOayYCMijlviJKJudWx	103.141.61.140	2026-07-10	[{"path":"\\/login","time":"06:41"}]	2026-07-10 06:41:42	2026-07-10 06:41:42
706	IPo6ed47jsAwoBTwTFBh93hjixPGhrByGYSQc6f1	114.10.144.136	2026-07-10	[{"path":"\\/login","time":"10:20"}]	2026-07-10 10:20:46	2026-07-10 10:20:46
867	3bPxmakNvlsr5A1GaPKG9SpHIKh4umB7KP5GQNmw	65.55.210.210	2026-07-24	[{"path":"\\/refund-policy","time":"01:35"}]	2026-07-24 01:35:20	2026-07-24 01:35:20
707	c6aILWbpy0wWV3EKP4khjpgdW6qIMqobK1Qup35R	114.10.144.136	2026-07-10	[{"path":"\\/","time":"10:21"},{"path":"\\/catalog","time":"10:21"},{"path":"\\/saas-marketplace","time":"10:21"},{"path":"\\/","time":"10:23"}]	2026-07-10 10:21:09	2026-07-10 10:23:51
703	0TTdazlF0Hf7WBa3JbCLXkYBHrHdrJvFsxuPScIN	103.141.61.140	2026-07-10	[{"path":"\\/","time":"06:41"},{"path":"\\/client-area","time":"06:42"},{"path":"\\/client-area\\/products","time":"06:42"},{"path":"\\/client-area\\/vps","time":"06:42"},{"path":"\\/","time":"06:42"},{"path":"\\/contact","time":"06:42"},{"path":"\\/","time":"06:43"},{"path":"\\/catalog","time":"06:43"}]	2026-07-10 06:41:55	2026-07-10 06:43:25
708	959smfEFZIl2AQCqpioSfz4u6C4MN4EoQaWamZvX	43.248.213.210	2026-07-10	[{"path":"\\/","time":"10:33"},{"path":"\\/login","time":"10:33"},{"path":"\\/","time":"12:30"},{"path":"\\/login","time":"12:30"},{"path":"\\/","time":"14:07"},{"path":"\\/catalog","time":"14:07"},{"path":"\\/saas-marketplace","time":"14:07"},{"path":"\\/","time":"14:07"}]	2026-07-10 10:33:43	2026-07-10 14:07:56
882	jkXEFDD4ANmPVlD1YFaxluTMTd4VVwO89MMEemok	66.249.79.7	2026-07-28	[{"path":"\\/domain-registration","time":"15:54"}]	2026-07-28 15:54:12	2026-07-28 15:54:12
709	MZkpdBIS63qrEW79Uza0HstacCvDTipcD4bSPXqN	103.147.8.19	2026-07-10	[{"path":"\\/login","time":"12:30"}]	2026-07-10 12:30:40	2026-07-10 12:30:40
897	pMhWEYtCxgIgOxSVEhpjjSd1NAp6d2zmaqEWTEuW	40.77.167.136	2026-07-31	[{"path":"\\/","time":"19:01"}]	2026-07-31 19:01:19	2026-07-31 19:01:19
912	CMON4de0dtUxYxbxB5WkU0waRjvJ1wsAGsuU49tV	203.83.42.251	2026-08-03	[{"path":"\\/","time":"11:25"},{"path":"\\/profile","time":"11:25"},{"path":"\\/cart","time":"11:25"},{"path":"\\/","time":"11:26"},{"path":"\\/client-area","time":"11:26"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:26"},{"path":"\\/client-area\\/hosting","time":"11:34"}]	2026-08-03 11:25:36	2026-08-03 11:34:55
977	4OvnfdOMSigvW1vab6caevmmZZNCby70vg4bfjsx	112.215.224.200	2026-08-05	[{"path":"\\/","time":"10:09"},{"path":"\\/client-area","time":"10:09"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:09"}]	2026-08-05 10:09:34	2026-08-05 10:09:49
925	jxeCLtvUDmLDnlwgr1tU0aGTg4JgVEeirPk2LXcV	103.147.8.19	2026-08-03	[{"path":"\\/","time":"17:47"},{"path":"\\/client-area","time":"17:48"},{"path":"\\/client-area\\/plugin","time":"17:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:48"},{"path":"\\/client-area\\/plugin","time":"17:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:51"}]	2026-08-03 17:47:55	2026-08-03 18:51:32
940	Lrl6Ec3IsuM0Vde6HccrUXDWVeoyGzM9v9T4jSYw	182.8.255.1	2026-08-04	[{"path":"\\/","time":"10:31"},{"path":"\\/client-area","time":"10:31"}]	2026-08-04 10:31:55	2026-08-04 10:31:58
993	2kn7l2CHHdmrPZEmifIbY6X7CKw0ZvpkMlsDOXZU	103.177.96.55	2026-08-06	[{"path":"\\/","time":"13:12"}]	2026-08-06 13:12:08	2026-08-06 13:12:08
1006	Ahm5AOc79QBtJTxWzL6Ga65MsoIfyafDeH9alXYP	52.167.144.191	2026-08-08	[{"path":"\\/about-us","time":"16:05"}]	2026-08-08 16:05:15	2026-08-08 16:05:15
1038	cJgyFqZczxTHsdGLDZM4aZRgqEd0WUbisiJLiZRx	182.2.134.185	2026-08-11	[{"path":"\\/","time":"09:02"},{"path":"\\/about-us","time":"09:03"},{"path":"\\/","time":"09:04"}]	2026-08-11 09:02:34	2026-08-11 09:04:08
1022	xaURESgCRzyZAm1AgEwlkkK87OMfXnPvLVsGh6aI	103.18.34.207	2026-08-10	[{"path":"\\/","time":"17:04"},{"path":"\\/login","time":"17:04"}]	2026-08-10 17:04:32	2026-08-10 17:04:34
1054	CHQF2sNuIGBwy5fiL8QkljVwQHE3vLLmB1kNH9GJ	82.158.131.175	2026-08-12	[{"path":"\\/client-area","time":"13:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:48"}]	2026-08-12 13:48:07	2026-08-12 13:48:11
868	U2svTzCSmxHAZvx6Ix7yJt9hd38aOlVcVhDVkheW	66.249.66.202	2026-07-24	[{"path":"\\/login","time":"01:39"}]	2026-07-24 01:39:13	2026-07-24 01:39:13
883	FiEyHFya9Osr9sJJxhox6UBl70FZ2lwwjKukI7N6	103.147.8.19	2026-07-28	[{"path":"\\/","time":"15:56"}]	2026-07-28 15:56:03	2026-07-28 15:56:03
898	ptmBvWdqjrmnQtUtz1Px5zP8xwsIB0wawJhkmu76	71.6.239.91	2026-07-31	[{"path":"\\/","time":"19:37"}]	2026-07-31 19:37:47	2026-07-31 19:37:47
913	YOSwfiYUvEda8vv7C6LdDh2NXyawd2uQMzR9kAn1	43.245.145.137	2026-08-03	[{"path":"\\/","time":"11:26"}]	2026-08-03 11:26:30	2026-08-03 11:26:30
926	pi7WPSkaCiE5VwfiVKfQH1Rsh5rCRSET8ZRlIdlZ	66.249.68.129	2026-08-04	[{"path":"\\/login","time":"05:57"}]	2026-08-04 05:57:53	2026-08-04 05:57:53
941	HWTQOzb5nGUXJmq03hqqkUcQDnwcVOeeFkD7uSzm	38.43.64.53	2026-08-04	[{"path":"\\/login","time":"10:32"}]	2026-08-04 10:32:01	2026-08-04 10:32:01
978	MYSO7xlUKpmWQAGurJ80w2ocTkY5ageo5efPHcit	177.249.62.133	2026-08-05	[{"path":"\\/","time":"10:18"}]	2026-08-05 10:18:25	2026-08-05 10:18:25
1007	jIkgIwZRhfaaP2hZVyUTf6ubpiPYmcApsGfO5mSn	52.167.144.25	2026-08-09	[{"path":"\\/saas-marketplace","time":"04:39"}]	2026-08-09 04:39:06	2026-08-09 04:39:06
1288	EnPR900CGbHPaP2XOdnjLUKnSssVu7kLUxJVTi9N	103.147.8.141	2026-09-07	[{"path":"\\/register","time":"11:24"},{"path":"\\/","time":"11:52"},{"path":"\\/login","time":"11:52"}]	2026-09-07 11:24:53	2026-09-07 11:52:14
1023	IaMLLESVyuOg7Zf3wEcXvKtEOFUWQEfx5VBSoK8v	103.18.34.207	2026-08-10	[{"path":"\\/","time":"17:05"},{"path":"\\/client-area","time":"17:05"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:05"}]	2026-08-10 17:05:02	2026-08-10 17:05:08
1039	jGJUvQsFsg1Riqupy0u2LkckXLHOhnZRjacwThzl	103.168.190.148	2026-08-11	[{"path":"\\/catalog","time":"11:56"}]	2026-08-11 11:56:06	2026-08-11 11:56:06
1055	h15QJZHOmZSpg4DCC3EeesesMErE11PREKz5nG8y	149.56.150.146	2026-08-12	[{"path":"\\/","time":"14:13"}]	2026-08-12 14:13:21	2026-08-12 14:13:21
1069	4kRe6B1Heei9VNkAx8xVSuWApY8o0jB741wXIjwn	82.158.131.175	2026-08-12	[{"path":"\\/login","time":"18:01"}]	2026-08-12 18:01:50	2026-08-12 18:01:50
1090	UTlaJbXyHVHsGD3N95lVPNDnBwSjYtgB6aphJW2u	103.247.22.195	2026-08-13	[{"path":"\\/admin\\/dashboard","time":"22:11"},{"path":"\\/admin\\/saas-management","time":"22:11"},{"path":"\\/admin\\/saas\\/create","time":"22:11"}]	2026-08-13 22:11:07	2026-08-13 22:11:15
1153	zAZiZdzWuZW2ZLrcMMDX5XuXTbAaymUWGVx3E7iP	66.249.68.128	2026-08-22	[{"path":"\\/","time":"19:08"}]	2026-08-22 19:08:22	2026-08-22 19:08:22
1170	Z4DKQrnx1VIiGCrC4gMjY4vkJfDeO0Szxg1GqDSI	36.65.244.17	2026-08-23	[{"path":"\\/","time":"23:35"}]	2026-08-23 23:35:25	2026-08-23 23:35:25
1188	m4fPCvzxN9fInnhsrPAzINahHy5IGN1ABww4tsTC	173.252.87.112	2026-08-26	[{"path":"\\/","time":"18:00"}]	2026-08-26 18:00:22	2026-08-26 18:00:23
1204	m781vYgnYLOjworIW7niEdVLXtVI72xcNt6yDdEE	114.10.39.88	2026-08-28	[{"path":"\\/","time":"17:07"}]	2026-08-28 17:07:12	2026-08-28 17:07:12
1219	iAeb2lCYTMRyav7fL3GfmsCeXXRCvNCcjhLP869r	66.249.64.171	2026-08-31	[{"path":"\\/faq","time":"03:29"}]	2026-08-31 03:29:14	2026-08-31 03:29:14
1233	Ne5FFpLA5xQZoRulv1OpCyLLVLkCD1eO9UKvxk4k	149.30.146.20	2026-08-31	[{"path":"\\/","time":"21:26"}]	2026-08-31 21:26:06	2026-08-31 21:26:06
1247	BUO434hD01eA8n8K5ChQkwtP0cupMlDrEygGsyCH	140.213.24.100	2026-09-01	[{"path":"\\/","time":"19:01"},{"path":"\\/client-area","time":"19:01"},{"path":"\\/client-area\\/plugin\\/manage","time":"19:01"}]	2026-09-01 19:01:45	2026-09-01 19:01:54
1261	646Pj86nRSDfP1X6qcWWSWsXZEkzEISvLDXSzYX6	66.249.79.36	2026-09-03	[{"path":"\\/","time":"01:14"}]	2026-09-03 01:14:42	2026-09-03 01:14:42
1274	j7FvpUdkw730cxUoidmDa5IkNJ1yP8BTG0AA6tho	114.10.16.173	2026-09-04	[{"path":"\\/","time":"15:11"},{"path":"\\/about-us","time":"15:11"}]	2026-09-04 15:11:07	2026-09-04 15:11:13
788	rCIABudfRRiu0SbhvmXWiFxCLi6ig4DzXnKBk80L	103.152.239.14	2026-07-14	[{"path":"\\/","time":"14:18"},{"path":"\\/catalog","time":"14:18"},{"path":"\\/services","time":"14:18"},{"path":"\\/join-partner","time":"14:18"},{"path":"\\/","time":"14:19"},{"path":"\\/catalog","time":"14:19"},{"path":"\\/saas-marketplace","time":"14:19"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"14:19"},{"path":"\\/cart","time":"14:19"},{"path":"\\/checkout","time":"14:20"},{"path":"\\/order\\/instruction\\/38","time":"14:20"},{"path":"\\/client-area\\/invoices","time":"14:20"},{"path":"\\/client-area\\/plugin","time":"14:21"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:31"},{"path":"\\/client-area\\/plugin","time":"14:31"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:46"},{"path":"\\/client-area\\/plugin","time":"14:46"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:46"},{"path":"\\/client-area\\/plugin","time":"14:46"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:47"},{"path":"\\/client-area\\/plugin","time":"14:49"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:49"},{"path":"\\/client-area\\/plugin","time":"15:03"}]	2026-07-14 14:18:13	2026-07-14 15:03:39
869	PdZqWYYQ8hYEbEhb5GS85znc282nfqmjUc0JJeI5	66.249.66.42	2026-07-24	[{"path":"\\/","time":"08:15"}]	2026-07-24 08:15:30	2026-07-24 08:15:30
884	vR2dYJ0G1RWsTVDzqhpWp7KPg8WxYHYJ5aPCyCyn	52.167.144.147	2026-07-28	[{"path":"\\/services","time":"20:25"}]	2026-07-28 20:25:20	2026-07-28 20:25:20
899	RN7q6y8EiVHirE3uODL5Wh75YMMkiLE5f0krwewv	66.249.68.128	2026-08-01	[{"path":"\\/contact","time":"06:46"}]	2026-08-01 06:46:12	2026-08-01 06:46:13
1234	R0uVxXQAfknP6RBRN4GVofT6R7yfyjm61dvulomD	149.30.146.20	2026-08-31	[{"path":"\\/vps-hosting","time":"21:26"},{"path":"\\/services","time":"21:27"}]	2026-08-31 21:26:34	2026-08-31 21:27:07
914	mKn6QVaL9hEzfXzkyhJeC4iyWf6UJqTPs3B0LlIf	103.147.8.19	2026-08-03	[{"path":"\\/","time":"11:35"},{"path":"\\/login","time":"11:35"}]	2026-08-03 11:35:23	2026-08-03 11:35:26
1070	bLoZTI9hYIW7G0Mo2Z2IF0kQoyjTVBV9DtiJcwQm	82.158.131.175	2026-08-12	[{"path":"\\/","time":"18:03"},{"path":"\\/client-area","time":"18:03"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:25"}]	2026-08-12 18:03:09	2026-08-12 18:25:37
1248	NNHbRiobtFdYv9LerxkZ2jZDOKneGmHxq2RXWA50	140.213.39.93	2026-09-01	[{"path":"\\/","time":"19:45"},{"path":"\\/login","time":"19:45"}]	2026-09-01 19:45:39	2026-09-01 19:45:41
942	pxLZhSRT9XRfrVTr1QEMrmqlZvVYrS67XZUWReOQ	182.8.255.1	2026-08-04	[{"path":"\\/","time":"10:33"},{"path":"\\/login","time":"10:55"}]	2026-08-04 10:33:24	2026-08-04 10:55:19
1091	VWCQB5qWEXofP16SajuifK6xl0hzGJrttl85dPmp	182.8.229.188	2026-08-13	[{"path":"\\/","time":"22:39"},{"path":"\\/services","time":"22:39"},{"path":"\\/","time":"22:39"},{"path":"\\/saas-marketplace","time":"22:40"}]	2026-08-13 22:39:47	2026-08-13 22:40:08
927	w4YGK6rpKnMzArFV1VdxgJcNQ4ksa1Ne7kC86DeR	182.8.255.1	2026-08-04	[{"path":"\\/","time":"09:39"},{"path":"\\/login","time":"09:39"},{"path":"\\/","time":"10:55"},{"path":"\\/login","time":"10:55"},{"path":"\\/","time":"11:36"},{"path":"\\/login","time":"11:36"}]	2026-08-04 09:39:04	2026-08-04 11:36:58
979	ImOhk8NcLu2bdOHiOdDM10EkHtoqpjZPTfzZXKz9	140.213.251.248	2026-08-05	[{"path":"\\/","time":"10:29"},{"path":"\\/login","time":"10:29"}]	2026-08-05 10:29:05	2026-08-05 10:29:29
1008	5QSIFX65UWoEiGGPMD9Cco4V95iuN7bV0Q6EfSxF	66.249.66.203	2026-08-09	[{"path":"\\/","time":"05:18"}]	2026-08-09 05:18:47	2026-08-09 05:18:47
1096	l2Hxo4dFBHOpOTmUN0jRZ1TTehC6OQbGTvIhJMSW	82.158.131.175	2026-08-14	[{"path":"\\/saas-marketplace","time":"12:22"},{"path":"\\/saas\\/langganan-paket-ngajakmyid","time":"12:23"},{"path":"\\/saas\\/langganan-paket-leadly","time":"12:23"},{"path":"\\/saas\\/langganan-paket-scanyukcom","time":"12:23"},{"path":"\\/","time":"12:23"},{"path":"\\/services","time":"12:24"},{"path":"\\/catalog","time":"12:24"},{"path":"\\/domain-registration","time":"12:24"},{"path":"\\/catalog","time":"12:30"},{"path":"\\/","time":"12:54"},{"path":"\\/domain-registration","time":"12:55"},{"path":"\\/","time":"13:01"},{"path":"\\/about-us","time":"13:01"},{"path":"\\/portfolio","time":"13:02"},{"path":"\\/services","time":"13:02"},{"path":"\\/","time":"13:02"},{"path":"\\/domain-registration","time":"13:17"},{"path":"\\/login","time":"13:35"},{"path":"\\/domain-registration","time":"13:36"},{"path":"\\/order\\/domain","time":"14:07"},{"path":"\\/login","time":"14:07"},{"path":"\\/","time":"16:48"},{"path":"\\/catalog","time":"16:49"}]	2026-08-14 12:22:54	2026-08-14 16:49:51
1024	Fo2nw3Ydpa9GOjHvIFf6OIUCDOtTvYRbwDSVSwQg	103.18.34.207	2026-08-10	[{"path":"\\/","time":"17:17"},{"path":"\\/login","time":"17:17"}]	2026-08-10 17:17:36	2026-08-10 17:17:38
1040	p5rs0tiMUAxipZIDx4Rnfu5hlX0vMNihBJwipcDr	103.147.8.19	2026-08-11	[{"path":"\\/","time":"17:04"},{"path":"\\/login","time":"17:04"}]	2026-08-11 17:04:04	2026-08-11 17:04:07
1056	1TD6SPJ0S32gD5JT6PC6okPdMlTtoGX8gkJJpRpZ	82.158.131.175	2026-08-12	[{"path":"\\/client-area\\/plugin\\/manage","time":"15:20"}]	2026-08-12 15:20:39	2026-08-12 15:20:39
1154	mdygmOTcTuRaAghkzIp1rqFexJczakKx65N0blRd	66.249.68.128	2026-08-22	[{"path":"\\/","time":"19:08"}]	2026-08-22 19:08:22	2026-08-22 19:08:22
1171	xdmFWhopQghZSKAXhiIPFb5qr6wO4fag2slY0GTv	114.10.120.61	2026-08-24	[{"path":"\\/","time":"08:56"}]	2026-08-24 08:56:08	2026-08-24 08:56:08
1189	5lste8F2y9tqEpMM0fzNqkLa1etSIEnZnJXhfc7u	173.252.87.37	2026-08-26	[{"path":"\\/","time":"18:00"}]	2026-08-26 18:00:22	2026-08-26 18:00:23
1205	n41n5aOflrSL2oixigs7XEkKvoG5P7Km83I60rmu	66.228.43.120	2026-08-28	[{"path":"\\/","time":"18:08"}]	2026-08-28 18:08:09	2026-08-28 18:08:09
1220	BxBTymyaI6rLYHQGIHs2vVNo0xuzPAgTOLVURJnG	66.249.64.170	2026-08-31	[{"path":"\\/register","time":"05:17"}]	2026-08-31 05:17:27	2026-08-31 05:17:28
1262	yXnNQPkQ9ijOKCnsTP3LoyJOZH11ln193JBb8PxN	66.249.71.172	2026-09-03	[{"path":"\\/portfolio","time":"01:30"}]	2026-09-03 01:30:52	2026-09-03 01:30:52
1275	Rm35pWFhJHU4HyZzvlvi2bbteTIhlJSz62JY0TV3	182.253.228.99	2026-09-04	[{"path":"\\/","time":"15:12"},{"path":"\\/about-us","time":"15:12"}]	2026-09-04 15:12:12	2026-09-04 15:12:16
1289	lvwV4dfvawt97otavtQc03zTLCU5atIPqKE09FPF	66.249.79.36	2026-09-07	[{"path":"\\/about-us","time":"11:29"}]	2026-09-07 11:29:01	2026-09-07 11:29:01
725	H2c653VPq3ciW2QOAti7moooq9UI437cXa4Vf7sn	103.147.8.19	2026-07-11	[{"path":"\\/","time":"05:18"},{"path":"\\/login","time":"05:18"},{"path":"\\/","time":"05:27"}]	2026-07-11 05:18:49	2026-07-11 05:27:53
711	CnIUfZNdCB8AFypKNKhdeQLEectYzJYGUHBrfUID	103.147.8.19	2026-07-10	[{"path":"\\/admin\\/dashboard","time":"14:08"},{"path":"\\/admin\\/products","time":"14:08"},{"path":"\\/admin\\/plugin-management","time":"14:08"},{"path":"\\/admin\\/plugin-customers","time":"14:08"},{"path":"\\/admin\\/plugin-management","time":"14:08"},{"path":"\\/admin\\/saas-management","time":"14:08"},{"path":"\\/admin\\/products","time":"14:08"},{"path":"\\/admin\\/products\\/create","time":"14:08"},{"path":"\\/admin\\/saas-management","time":"14:08"},{"path":"\\/admin\\/saas\\/create","time":"14:08"},{"path":"\\/admin\\/plugin-management","time":"14:08"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"14:08"},{"path":"\\/saas\\/chatbot-plugin","time":"14:08"},{"path":"\\/admin\\/plugin-management","time":"14:10"},{"path":"\\/saas\\/chatbot-plugin","time":"14:10"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"14:10"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"14:10"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"14:10"},{"path":"\\/admin\\/plugin-management","time":"14:11"},{"path":"\\/saas-marketplace","time":"14:11"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"14:11"},{"path":"\\/login","time":"14:11"},{"path":"\\/saas\\/chatbot-plugin","time":"14:11"},{"path":"\\/login","time":"14:11"},{"path":"\\/saas-marketplace","time":"14:12"},{"path":"\\/about-us","time":"14:12"},{"path":"\\/portfolio","time":"14:12"},{"path":"\\/contact","time":"14:12"},{"path":"\\/","time":"14:12"},{"path":"\\/admin\\/saas-management","time":"14:13"},{"path":"\\/admin\\/plugin-customers","time":"14:13"},{"path":"\\/admin\\/plugin-management","time":"14:13"},{"path":"\\/","time":"14:17"},{"path":"\\/admin\\/plugin-management","time":"14:17"},{"path":"\\/admin\\/plugin-customers","time":"14:17"},{"path":"\\/admin\\/saas-management","time":"14:17"},{"path":"\\/saas-marketplace","time":"14:20"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"14:20"},{"path":"\\/login","time":"14:20"},{"path":"\\/admin\\/plugin-management","time":"14:26"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"14:26"},{"path":"\\/admin\\/plugin-customers","time":"14:27"},{"path":"\\/admin\\/orders","time":"14:29"},{"path":"\\/admin\\/orders\\/20","time":"14:29"},{"path":"\\/admin\\/plugin-customers","time":"14:30"},{"path":"\\/admin\\/dashboard","time":"14:31"}]	2026-07-10 14:08:09	2026-07-10 14:31:07
712	yWEmklNLbvtYx6g9XUACHoJ1R7hSGn2s2Qmq6NRq	17.241.219.220	2026-07-10	[{"path":"\\/contact","time":"21:10"}]	2026-07-10 21:10:41	2026-07-10 21:10:41
719	JhfFJrN1cdVyBFCZtrztf3236RW7Rnwdu1b1mkJv	182.253.228.97	2026-07-11	[{"path":"\\/","time":"04:59"},{"path":"\\/client-area","time":"05:00"},{"path":"\\/client-area\\/saas","time":"05:01"},{"path":"\\/catalog","time":"05:01"},{"path":"\\/services","time":"05:01"},{"path":"\\/about-us","time":"05:01"},{"path":"\\/client-area","time":"05:01"},{"path":"\\/client-area\\/products","time":"05:02"},{"path":"\\/client-area\\/domain","time":"05:02"},{"path":"\\/client-area\\/vps","time":"05:02"},{"path":"\\/client-area\\/invoices","time":"05:02"},{"path":"\\/client-area\\/domain","time":"05:02"},{"path":"\\/client-area\\/products","time":"05:02"},{"path":"\\/client-area","time":"05:02"}]	2026-07-11 04:59:58	2026-07-11 05:02:28
717	vIAYLUCAdjjT9vm52oux9bh3NoDOYbwxJjlb7Nxz	182.253.228.97	2026-07-11	[{"path":"\\/admin\\/dashboard","time":"04:56"},{"path":"\\/admin\\/plugin-customers","time":"04:56"},{"path":"\\/admin\\/plugin-management","time":"04:56"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"04:56"},{"path":"\\/","time":"04:58"},{"path":"\\/login","time":"04:58"}]	2026-07-11 04:56:36	2026-07-11 04:58:58
718	L9kaJmwisOXbDfqkHDuw1pri8pK83vIk28j6fID2	182.253.228.97	2026-07-11	[{"path":"\\/login","time":"04:59"}]	2026-07-11 04:59:16	2026-07-11 04:59:16
714	yU8Jt9VpFOV1HUyNlnWkMFo9dvJSQppkfUVSaYAt	103.147.8.19	2026-07-11	[{"path":"\\/","time":"02:01"},{"path":"\\/saas-marketplace","time":"02:01"},{"path":"\\/saas\\/chatbot-plugin","time":"02:01"}]	2026-07-11 02:01:23	2026-07-11 02:01:37
721	QFDQBQ0WjCYVuyrm2nNF8XfHyMsyQrHghi7PC0Xa	182.253.228.97	2026-07-11	[{"path":"\\/saas\\/chatbot-plugin","time":"05:03"},{"path":"\\/cart","time":"05:03"},{"path":"\\/saas-marketplace","time":"05:04"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"05:04"},{"path":"\\/cart","time":"05:04"},{"path":"\\/checkout","time":"05:04"},{"path":"\\/order\\/instruction\\/21","time":"05:04"},{"path":"\\/client-area\\/invoices","time":"05:05"},{"path":"\\/order\\/instruction\\/21","time":"05:05"}]	2026-07-11 05:03:37	2026-07-11 05:05:41
720	GyI0KR1H6kjnIoeDDpyxrf2LT3WisFN0x24RdPp2	182.253.228.97	2026-07-11	[{"path":"\\/","time":"05:02"},{"path":"\\/saas-marketplace","time":"05:03"},{"path":"\\/saas\\/chatbot-plugin","time":"05:03"},{"path":"\\/login","time":"05:03"}]	2026-07-11 05:02:34	2026-07-11 05:03:29
722	mTB0lLKhk6ULVvKPd8fiJvpESJZ9KLSpFYMNDF9w	182.253.228.97	2026-07-11	[{"path":"\\/","time":"05:05"}]	2026-07-11 05:05:55	2026-07-11 05:05:55
715	fkCAzOOxexG564oSBai61dgZmxmuRbaojQDSChDZ	103.147.8.19	2026-07-11	[{"path":"\\/admin\\/dashboard","time":"02:02"},{"path":"\\/admin\\/plugin-management","time":"02:02"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"02:02"},{"path":"\\/admin\\/plugin-management","time":"02:02"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"02:02"},{"path":"\\/admin\\/plugin-management","time":"02:02"}]	2026-07-11 02:02:11	2026-07-11 02:02:42
713	tyWgIpDqpppNdPJp1cThVjnwnDVcrFICj7n24GNr	114.10.11.111	2026-07-11	[{"path":"\\/","time":"01:33"},{"path":"\\/catalog","time":"01:33"},{"path":"\\/saas-marketplace","time":"01:33"},{"path":"\\/saas\\/chatbot-plugin","time":"01:33"},{"path":"\\/saas-marketplace","time":"02:03"},{"path":"\\/saas\\/chatbot-plugin","time":"02:03"}]	2026-07-11 01:33:05	2026-07-11 02:03:45
716	ba1Rx69Cck5Um3N88IKQAh24YGbJZrPLXendDbqb	182.253.228.97	2026-07-11	[{"path":"\\/","time":"04:56"},{"path":"\\/login","time":"04:56"}]	2026-07-11 04:56:25	2026-07-11 04:56:28
724	pobsk945b2XUcj2p32AwrWKQyAGFmAAdUGiqXf87	182.253.228.97	2026-07-11	[{"path":"\\/","time":"05:09"},{"path":"\\/client-area","time":"05:09"},{"path":"\\/client-area\\/plugin","time":"05:10"},{"path":"\\/","time":"06:12"},{"path":"\\/saas-marketplace","time":"06:12"},{"path":"\\/saas\\/chatbot-plugin","time":"06:12"},{"path":"\\/saas-marketplace","time":"06:12"},{"path":"\\/saas\\/chatbot-plugin","time":"06:14"},{"path":"\\/cart","time":"06:14"},{"path":"\\/saas-marketplace","time":"06:16"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"06:16"},{"path":"\\/cart","time":"06:16"},{"path":"\\/checkout","time":"06:17"},{"path":"\\/order\\/instruction\\/23","time":"06:17"},{"path":"\\/client-area\\/invoices","time":"06:18"},{"path":"\\/order\\/instruction\\/23","time":"06:18"},{"path":"\\/client-area","time":"06:19"},{"path":"\\/client-area\\/plugin","time":"06:19"}]	2026-07-11 05:09:43	2026-07-11 06:19:34
726	uJhuX2YtXfQeHOrEijwPOxOaSVUEcEunOkp4Z4xC	103.147.8.19	2026-07-11	[{"path":"\\/login","time":"05:18"}]	2026-07-11 05:18:56	2026-07-11 05:18:56
723	6Tk7hyTrtyS0UDBmQYB6EVMGBUReqkqFFcmFzrHp	182.253.228.97	2026-07-11	[{"path":"\\/admin\\/dashboard","time":"05:06"},{"path":"\\/admin\\/plugin-customers","time":"05:06"},{"path":"\\/admin\\/orders","time":"05:06"},{"path":"\\/admin\\/orders\\/21","time":"05:06"},{"path":"\\/","time":"05:09"},{"path":"\\/login","time":"05:09"}]	2026-07-11 05:06:08	2026-07-11 05:09:35
870	9grUqxRXpF13c6cBv19KjetLgMpUycX44LEbFfPy	66.249.66.202	2026-07-24	[{"path":"\\/","time":"11:47"}]	2026-07-24 11:47:58	2026-07-24 11:47:58
727	7rYElHlu7AI5KHAMz4m5nu80rkaoqHcIxXX5Cagf	103.147.8.19	2026-07-11	[{"path":"\\/","time":"05:19"},{"path":"\\/client-area","time":"05:19"},{"path":"\\/client-area\\/plugin","time":"05:19"}]	2026-07-11 05:19:03	2026-07-11 05:19:08
885	Qh6sknkFi6Jg4qcCGqayFV4zMCpk4h5Q31myIurH	66.249.66.202	2026-07-29	[{"path":"\\/","time":"12:39"}]	2026-07-29 12:39:14	2026-07-29 12:39:14
728	KrJk58IcfRiyR6Wdxzmo6X7MrFYnoRaDxgVw9jgy	103.147.8.19	2026-07-11	[{"path":"\\/","time":"05:22"},{"path":"\\/login","time":"05:22"}]	2026-07-11 05:22:26	2026-07-11 05:22:27
900	j06yxisZZzKVgnx5r0WbYkIHaM7NL4sh6cZQ8024	66.249.68.137	2026-08-02	[{"path":"\\/vps-hosting","time":"00:37"}]	2026-08-02 00:37:35	2026-08-02 00:37:35
928	zsCSrvScaobOL4FAotrXXTmNBcTdHFLpoctx0ORl	182.8.255.1	2026-08-04	[{"path":"\\/login","time":"09:39"}]	2026-08-04 09:39:21	2026-08-04 09:39:21
943	N8RYYefzHTU1VXPAUm61uqNaWwuzkZit2ogYj1Gh	112.215.145.86	2026-08-04	[{"path":"\\/","time":"11:37"},{"path":"\\/client-area","time":"11:37"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:37"}]	2026-08-04 11:37:25	2026-08-04 11:37:35
1009	QCT7JsCKdNWD0tlW38XakVScqrRWjNNdDtrXDtUX	66.249.66.202	2026-08-09	[{"path":"\\/portfolio","time":"08:15"}]	2026-08-09 08:15:17	2026-08-09 08:15:18
1025	4L5RtiINfhDxGjIosxshsig73uQzJF8TncEWzsPu	103.18.34.207	2026-08-10	[{"path":"\\/","time":"17:17"},{"path":"\\/client-area","time":"17:17"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:17"},{"path":"\\/","time":"17:32"},{"path":"\\/services","time":"17:32"},{"path":"\\/catalog","time":"17:33"},{"path":"\\/saas-marketplace","time":"17:33"}]	2026-08-10 17:17:51	2026-08-10 17:33:06
1041	sIuO2qF7wy3v61sekMzsZPrPBeQ8arl4oNtOivGJ	103.147.8.19	2026-08-11	[{"path":"\\/","time":"17:04"},{"path":"\\/client-area","time":"17:04"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:04"}]	2026-08-11 17:04:22	2026-08-11 17:04:31
735	rlcX85hcRnLDrxwKWcVjIMW6ie8VOujWcIrwyJYB	182.253.228.97	2026-07-11	[{"path":"\\/","time":"08:26"},{"path":"\\/login","time":"08:26"}]	2026-07-11 08:26:38	2026-07-11 08:26:39
733	sOk0v21WX2vk9RLr8ptMGVy24ExFk6npnhLvkU50	182.253.150.3	2026-07-11	[{"path":"\\/","time":"07:51"},{"path":"\\/login","time":"08:26"}]	2026-07-11 07:51:10	2026-07-11 08:26:46
730	nFDVwHwDLPDNg2jKO1D6ivvnIgLd2YnPuqti6Izf	103.147.8.19	2026-07-11	[{"path":"\\/admin\\/dashboard","time":"05:28"},{"path":"\\/login","time":"05:28"},{"path":"\\/admin\\/plugin-customers","time":"05:28"},{"path":"\\/admin\\/plugin-management","time":"05:28"},{"path":"\\/admin\\/orders","time":"05:28"},{"path":"\\/admin\\/orders\\/22","time":"05:28"},{"path":"\\/admin\\/orders","time":"06:08"},{"path":"\\/admin\\/orders\\/22","time":"06:08"},{"path":"\\/admin\\/orders","time":"06:12"},{"path":"\\/admin\\/orders\\/22","time":"06:12"},{"path":"\\/admin\\/plugin-customers","time":"06:20"},{"path":"\\/admin\\/orders","time":"06:20"},{"path":"\\/admin\\/monitoring","time":"06:20"},{"path":"\\/admin\\/plugin-management","time":"06:23"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"06:23"},{"path":"\\/admin\\/orders","time":"06:26"},{"path":"\\/admin\\/orders\\/24","time":"06:26"},{"path":"\\/admin\\/plugin-management","time":"06:27"},{"path":"\\/admin\\/plugin-customers","time":"06:27"},{"path":"\\/admin\\/orders","time":"06:27"}]	2026-07-11 05:28:06	2026-07-11 06:27:21
748	GJF8R3FcqtQy9fsU73kQrgSSJrNjWivsOBYxVVpl	103.18.34.205	2026-07-13	[{"path":"\\/login","time":"01:37"}]	2026-07-13 01:37:43	2026-07-13 01:37:43
736	oDrP5dt0OlqR9UZ8kW5SZIl0MYTqX3HzVfJR5uMW	182.253.228.97	2026-07-11	[{"path":"\\/","time":"08:26"},{"path":"\\/client-area","time":"08:26"},{"path":"\\/client-area\\/plugin","time":"08:26"}]	2026-07-11 08:26:55	2026-07-11 08:26:59
729	DbZUbWMMvbjEiFccTyzpS4qrZXKlLPlxeq76n3ej	103.147.8.19	2026-07-11	[{"path":"\\/client-area","time":"05:22"},{"path":"\\/client-area\\/plugin","time":"05:24"},{"path":"\\/","time":"05:25"},{"path":"\\/client-area","time":"05:25"},{"path":"\\/client-area\\/plugin","time":"05:25"},{"path":"\\/saas-marketplace","time":"05:25"},{"path":"\\/saas\\/chatbot-plugin","time":"05:25"},{"path":"\\/cart","time":"05:26"},{"path":"\\/checkout","time":"05:26"},{"path":"\\/order\\/instruction\\/22","time":"05:26"},{"path":"\\/client-area","time":"05:26"},{"path":"\\/client-area\\/invoices","time":"05:26"},{"path":"\\/order\\/instruction\\/22","time":"05:26"},{"path":"\\/","time":"05:28"},{"path":"\\/client-area","time":"05:28"},{"path":"\\/client-area\\/plugin","time":"05:28"},{"path":"\\/client-area\\/products","time":"06:09"},{"path":"\\/client-area\\/services\\/26\\/manage","time":"06:09"},{"path":"\\/client-area\\/products","time":"06:09"},{"path":"\\/client-area\\/plugin","time":"06:10"},{"path":"\\/client-area\\/domain","time":"06:10"},{"path":"\\/client-area\\/hosting","time":"06:10"},{"path":"\\/client-area\\/plugin","time":"06:10"},{"path":"\\/client-area\\/products","time":"06:10"},{"path":"\\/client-area\\/services\\/26\\/manage","time":"06:10"},{"path":"\\/client-area\\/products","time":"06:19"},{"path":"\\/client-area\\/services\\/26\\/manage","time":"06:19"},{"path":"\\/client-area\\/plugin","time":"06:19"},{"path":"\\/client-area\\/products","time":"06:19"},{"path":"\\/client-area\\/plugin","time":"06:19"},{"path":"\\/client-area\\/products","time":"06:19"},{"path":"\\/client-area\\/services\\/26\\/manage","time":"06:19"},{"path":"\\/client-area\\/products","time":"06:20"},{"path":"\\/client-area\\/services\\/26\\/manage","time":"06:21"},{"path":"\\/client-area\\/products","time":"06:21"},{"path":"\\/client-area\\/plugin","time":"06:23"},{"path":"\\/client-area\\/products","time":"06:24"},{"path":"\\/client-area\\/services\\/26\\/manage","time":"06:24"},{"path":"\\/catalog","time":"06:26"},{"path":"\\/saas-marketplace","time":"06:26"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"06:26"},{"path":"\\/cart","time":"06:26"},{"path":"\\/checkout","time":"06:26"},{"path":"\\/order\\/instruction\\/24","time":"06:26"},{"path":"\\/client-area\\/invoices","time":"06:26"},{"path":"\\/client-area\\/plugin","time":"06:26"},{"path":"\\/client-area\\/products","time":"06:56"},{"path":"\\/client-area\\/services\\/29\\/manage","time":"06:56"},{"path":"\\/client-area\\/products","time":"06:57"},{"path":"\\/client-area\\/plugin","time":"06:57"},{"path":"\\/client-area\\/saas","time":"06:57"},{"path":"\\/client-area\\/vps","time":"06:57"},{"path":"\\/client-area\\/hosting","time":"06:57"},{"path":"\\/client-area\\/domain","time":"06:57"},{"path":"\\/client-area","time":"06:57"},{"path":"\\/client-area\\/plugin","time":"06:57"},{"path":"\\/client-area\\/profile","time":"06:57"},{"path":"\\/client-area","time":"06:57"},{"path":"\\/","time":"06:57"}]	2026-07-11 05:22:39	2026-07-11 06:57:44
731	KuBklX408YLqValgvxD5l0PMDkTNK1AAnSFOVDwS	182.253.228.99	2026-07-11	[{"path":"\\/","time":"06:43"},{"path":"\\/login","time":"07:33"}]	2026-07-11 06:43:47	2026-07-11 07:33:23
737	uZGCt5H79waX4LDHe2qGbqj8TOMfks7IhDyxMtNJ	182.253.150.5	2026-07-11	[{"path":"\\/","time":"09:54"}]	2026-07-11 09:54:38	2026-07-11 09:54:38
732	L8M5cKgKLiPf8Ow74wiegZfOjGiMkFcs41Eo5UBd	182.253.228.99	2026-07-11	[{"path":"\\/","time":"07:33"},{"path":"\\/client-area","time":"07:33"},{"path":"\\/client-area\\/plugin","time":"07:33"}]	2026-07-11 07:33:30	2026-07-11 07:33:34
734	oMgFmBtn2c3WoXxGtZkGFHjj7s8AbL8M1T9NNOMh	40.77.167.3	2026-07-11	[{"path":"\\/order\\/domain","time":"07:55"}]	2026-07-11 07:55:41	2026-07-11 07:55:41
752	NNOROnhVuca5Z7VZ3v91GoWu6bgG6glBQ9jjyNjq	103.18.34.205	2026-07-13	[{"path":"\\/","time":"06:12"},{"path":"\\/client-area","time":"06:12"},{"path":"\\/client-area\\/plugin","time":"06:12"},{"path":"\\/client-area\\/products","time":"06:13"},{"path":"\\/client-area\\/services\\/23\\/manage","time":"06:13"},{"path":"\\/client-area\\/plugin","time":"06:16"},{"path":"\\/client-area\\/saas","time":"06:16"},{"path":"\\/client-area\\/plugin","time":"06:16"},{"path":"\\/client-area\\/saas","time":"07:58"},{"path":"\\/client-area\\/plugin","time":"07:58"}]	2026-07-13 06:12:16	2026-07-13 07:58:16
738	InbbhNd2DCAqNmKa5Z8Z3YHzaUGsoVhV9yjFNnZr	182.253.150.5	2026-07-11	[{"path":"\\/","time":"19:37"},{"path":"\\/login","time":"19:37"}]	2026-07-11 19:37:41	2026-07-11 19:37:43
739	7xYdx90jRqkTlWUFJ64pHGdK7gqlCgt0dP82kIHO	182.253.150.5	2026-07-11	[{"path":"\\/login","time":"19:37"}]	2026-07-11 19:37:50	2026-07-11 19:37:50
754	cKug0uGonFCVEDH4WofthezSiiHiR9AZGn8MDFDL	54.241.144.195	2026-07-13	[{"path":"\\/","time":"09:27"}]	2026-07-13 09:27:07	2026-07-13 09:27:07
740	BqKv3pkpDhpuS9HHH9eXlgPN1LRHv766H0jUP89E	182.253.150.5	2026-07-11	[{"path":"\\/","time":"19:37"},{"path":"\\/client-area","time":"19:38"},{"path":"\\/client-area\\/plugin","time":"19:38"}]	2026-07-11 19:37:58	2026-07-11 19:38:20
741	HGHRrUjWeuvtx9D2UIdaVj6RUhTiGjQJTrG7zq8s	182.253.150.5	2026-07-11	[{"path":"\\/","time":"19:47"}]	2026-07-11 19:47:45	2026-07-11 19:47:45
742	rlqSodNbWX1N4SiabkRGRry3RCxDxZHS8X1s6Ql4	66.249.79.8	2026-07-11	[{"path":"\\/","time":"21:42"}]	2026-07-11 21:42:47	2026-07-11 21:42:47
743	fh2ZU7KbIpEM1BE4m0prNwZUw7Sp8FPfvCX7Lzvx	66.249.79.32	2026-07-12	[{"path":"\\/order\\/cpanel","time":"02:21"}]	2026-07-12 02:21:11	2026-07-12 02:21:11
744	N9io6RUEOJYi0Fotvb2k2OWCc36MxGM2fUcdMA8m	103.18.34.205	2026-07-12	[{"path":"\\/","time":"14:02"}]	2026-07-12 14:02:04	2026-07-12 14:02:04
745	QHohypELiHPhh2gsWxf6YPc1azEdxH6i6ptZsiLy	149.56.160.213	2026-07-12	[{"path":"\\/","time":"14:18"}]	2026-07-12 14:18:19	2026-07-12 14:18:19
746	S4HJ9qK5h3XKfJoS5OZDKaoxvuSjEdRIn9aD16YI	199.30.24.4	2026-07-12	[{"path":"\\/","time":"23:40"}]	2026-07-12 23:40:16	2026-07-12 23:40:16
753	osx02DnCHojCnLABaoRDqDQg3OW5vtmc6WdKETlx	180.240.216.108	2026-07-13	[{"path":"\\/vps-hosting","time":"09:04"}]	2026-07-13 09:04:16	2026-07-13 09:04:16
750	zTMkzr2of6nTJU7ryczj7BBosdWbam5idwETK1ph	103.18.34.205	2026-07-13	[{"path":"\\/admin\\/dashboard","time":"01:40"},{"path":"\\/admin\\/chatbot\\/responses","time":"01:40"},{"path":"\\/admin\\/dashboard","time":"01:41"},{"path":"\\/admin\\/monitoring","time":"01:41"},{"path":"\\/admin\\/orders","time":"01:41"},{"path":"\\/admin\\/monitoring","time":"01:41"}]	2026-07-13 01:40:04	2026-07-13 01:41:08
749	FZl17PpQUlTLwvst6YR3RagrWuWuUegNj6F2JYuE	103.18.34.205	2026-07-13	[{"path":"\\/","time":"01:37"},{"path":"\\/client-area","time":"01:37"},{"path":"\\/client-area\\/plugin","time":"01:37"},{"path":"\\/client-area\\/saas","time":"01:38"},{"path":"\\/client-area\\/plugin","time":"01:38"},{"path":"\\/client-area\\/products","time":"01:38"},{"path":"\\/client-area\\/services\\/23\\/manage","time":"01:38"}]	2026-07-13 01:37:50	2026-07-13 01:38:25
747	HAimosJeF6eRhHcyWoppJGeLLCuUDzDPfzN2GJXm	103.18.34.205	2026-07-13	[{"path":"\\/","time":"01:37"},{"path":"\\/login","time":"01:37"},{"path":"\\/","time":"01:39"}]	2026-07-13 01:37:33	2026-07-13 01:39:53
751	RkxVrBcMltgTAbrQwEv5oIdtTT3lFR6sEyduDHk5	103.18.34.205	2026-07-13	[{"path":"\\/login","time":"06:12"}]	2026-07-13 06:12:09	2026-07-13 06:12:09
755	PLVoAtev6WkYFAlrnHdfFvGbLfbKFkb8ysLUFMd2	103.18.34.205	2026-07-13	[{"path":"\\/login","time":"10:43"}]	2026-07-13 10:43:29	2026-07-13 10:43:29
757	TxbmImyNvRDdLbu5ukDQZcWzl0oJ21YbdO4Otrno	103.18.34.205	2026-07-13	[{"path":"\\/login","time":"10:44"}]	2026-07-13 10:44:03	2026-07-13 10:44:03
871	tSRFRDWYeUERI1iafdCFhHrPzZEUHJ99XAlQXBw5	140.213.141.189	2026-07-24	[{"path":"\\/","time":"15:18"}]	2026-07-24 15:18:13	2026-07-24 15:18:13
886	jVrBU5ltDvP76gv6XXmmCcyHezFsAqB5FOX3bc3u	66.249.66.202	2026-07-29	[{"path":"\\/","time":"12:39"}]	2026-07-29 12:39:14	2026-07-29 12:39:15
901	cPjzv1tDWfdnZ6IqfL2N55ruR2ChYUNXdr0CEx3k	66.249.68.128	2026-08-02	[{"path":"\\/","time":"03:26"}]	2026-08-02 03:26:22	2026-08-02 03:26:22
929	6kBCYBgbAFpmQ5IHEhm6R2NC7GXwOga7Jj851Tq2	182.8.255.1	2026-08-04	[{"path":"\\/","time":"09:39"},{"path":"\\/client-area","time":"09:39"},{"path":"\\/client-area\\/plugin\\/manage","time":"09:39"}]	2026-08-04 09:39:31	2026-08-04 09:39:44
981	cioJyLkRu4qpDPLnD57HgbQyZSEDXJSa0Lt1BDma	66.249.68.129	2026-08-05	[{"path":"\\/catalog","time":"11:41"}]	2026-08-05 11:41:27	2026-08-05 11:41:27
872	wIsQJtRJozpcIyGJyIdmtp8Dn1DUEyqbIPbjJvhB	182.8.255.138	2026-07-24	[{"path":"\\/","time":"19:26"}]	2026-07-24 19:26:02	2026-07-24 19:26:02
887	pEfChnpXOKyOjFtnc641jTTI87zD8VxB1oEEQBd3	66.249.68.129	2026-07-29	[{"path":"\\/domain-registration","time":"23:20"}]	2026-07-29 23:20:57	2026-07-29 23:20:57
902	Gdxi6CsjnDUjDQewMqFIcTbt6Mgd41JCF3Uk7V1O	182.0.135.208	2026-08-02	[{"path":"\\/","time":"06:55"}]	2026-08-02 06:55:55	2026-08-02 06:55:55
982	GK9ZWHmNaiCKFbqeOS8GQ5lXogguXBR6HWNJt9b2	66.249.68.128	2026-08-05	[{"path":"\\/vps-hosting","time":"12:37"}]	2026-08-05 12:37:37	2026-08-05 12:37:37
915	XbwkMNAgULTVBtGHkpXmJsfVRm0TADs0XJlBY13m	103.147.8.19	2026-08-03	[{"path":"\\/","time":"11:35"},{"path":"\\/client-area","time":"11:35"},{"path":"\\/client-area\\/domain","time":"11:36"},{"path":"\\/client-area\\/products","time":"11:36"},{"path":"\\/client-area\\/hosting","time":"11:36"},{"path":"\\/catalog","time":"11:36"},{"path":"\\/saas-marketplace","time":"11:36"},{"path":"\\/saas\\/chatbot-plugin","time":"11:36"},{"path":"\\/cart","time":"11:36"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"11:36"},{"path":"\\/cart","time":"11:36"},{"path":"\\/checkout","time":"11:36"},{"path":"\\/order\\/instruction\\/47","time":"11:37"},{"path":"\\/client-area","time":"11:37"},{"path":"\\/client-area\\/plugin","time":"11:37"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:37"},{"path":"\\/client-area\\/plugin","time":"11:37"}]	2026-08-03 11:35:51	2026-08-03 11:37:37
1010	evH20Gtvp5GGxjMqp8RWIXkUbrf9nAwMxkWknzOa	202.8.41.126	2026-08-09	[{"path":"\\/","time":"16:36"}]	2026-08-09 16:36:19	2026-08-09 16:36:19
930	LnoS9EPSBOXeYxjwMJanb0YysykJwq8joPnPhlSG	182.8.255.1	2026-08-04	[{"path":"\\/","time":"09:40"},{"path":"\\/login","time":"09:46"}]	2026-08-04 09:40:38	2026-08-04 09:46:11
1026	iKluRJ7EdinNzcfoZ7XZbn6izLxcwGxQ09WyrZKA	114.10.16.93	2026-08-10	[{"path":"\\/","time":"17:29"}]	2026-08-10 17:29:02	2026-08-10 17:29:02
1042	31lCl6u5IZq5GDbSqHsdvt5WFlbkYPOnadkJjKZ8	103.147.8.19	2026-08-11	[{"path":"\\/","time":"17:19"},{"path":"\\/login","time":"17:19"}]	2026-08-11 17:19:57	2026-08-11 17:19:59
1057	LUywLTvfBxETmlwLmwShQu2FoG1ZiM1RWmxaYahe	82.158.131.175	2026-08-12	[{"path":"\\/","time":"15:23"},{"path":"\\/login","time":"15:23"}]	2026-08-12 15:23:46	2026-08-12 15:23:59
1071	pyDAOouptzTZVvX19iQkLGESiXSLuyyIHm20Fn4a	82.158.131.175	2026-08-12	[{"path":"\\/login","time":"18:37"}]	2026-08-12 18:37:24	2026-08-12 18:37:24
1155	n8Zdx6SP2fDFu14wSyHI0NXeGr5aXpWnnYmoJU6I	52.167.144.213	2026-08-22	[{"path":"\\/domain-registration","time":"21:36"}]	2026-08-22 21:36:23	2026-08-22 21:36:23
1172	BTvzv81c7JRQDy6JM4bCmHqMV689IErU0XaL0QVT	74.7.242.130	2026-08-24	[{"path":"\\/","time":"10:32"}]	2026-08-24 10:32:18	2026-08-24 10:32:18
1190	OTlkz1cEVqwodVDmHU4AuHhLbBxs3xskxPfc2VKk	24.140.71.151	2026-08-26	[{"path":"\\/about-us","time":"18:45"}]	2026-08-26 18:45:41	2026-08-26 18:45:41
1206	S9SOE1z0epNsQAiWSwd3b8LLUaRumhQTAqxoHnyX	66.249.66.98	2026-08-28	[{"path":"\\/","time":"20:13"}]	2026-08-28 20:13:09	2026-08-28 20:13:09
1221	zRf1GgMkQOwEzrKsTprL80Cgou6QyZZMF9EOBEuu	66.249.66.70	2026-08-31	[{"path":"\\/","time":"11:12"}]	2026-08-31 11:12:03	2026-08-31 11:12:03
1235	jioLbanWhWiI1sT60kwJknFvypdFrjqE6FAeMvIu	66.249.71.172	2026-09-01	[{"path":"\\/services","time":"05:06"}]	2026-09-01 05:06:40	2026-09-01 05:06:40
1249	wX4BvUB0o3858XGHV7xiZ8w8lQYyPzGNu5fhs7fc	140.213.39.93	2026-09-01	[{"path":"\\/","time":"19:45"},{"path":"\\/client-area","time":"19:45"},{"path":"\\/client-area\\/plugin\\/manage","time":"19:45"}]	2026-09-01 19:45:48	2026-09-01 19:45:56
1263	4Wvlii1s5Bc74aoG7ltd8GzlGkxmiHDfWKdZ1ZP4	182.253.131.1	2026-09-03	[{"path":"\\/","time":"14:00"},{"path":"\\/login","time":"14:00"}]	2026-09-03 14:00:18	2026-09-03 14:00:20
1276	jOvU4XB0xD3cWI3Gzm5l2ueBXeV9TmfrnqnvOsmy	103.188.50.120	2026-09-04	[{"path":"\\/about-us","time":"16:18"}]	2026-09-04 16:18:27	2026-09-04 16:18:27
1290	QImKFgrYCGQlD6rz1J0xmy5t6sAYYoZHSdHrywjG	103.147.8.141	2026-09-07	[{"path":"\\/","time":"11:52"},{"path":"\\/client-area","time":"11:52"},{"path":"\\/client-area\\/saas","time":"11:52"}]	2026-09-07 11:52:20	2026-09-07 11:52:28
756	dmNedfCoiRRoeAOh3LWO5bwVZJRc0PsCPxHaxLjB	103.18.34.205	2026-07-13	[{"path":"\\/client-area\\/plugin","time":"10:43"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:43"},{"path":"\\/client-area\\/plugin","time":"10:43"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:43"},{"path":"\\/client-area\\/plugin","time":"10:43"},{"path":"\\/catalog","time":"10:43"},{"path":"\\/saas-marketplace","time":"10:44"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"10:44"},{"path":"\\/cart","time":"10:44"},{"path":"\\/checkout","time":"10:44"},{"path":"\\/order\\/instruction\\/25","time":"10:44"},{"path":"\\/client-area\\/invoices","time":"10:45"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:45"},{"path":"\\/client-area\\/plugin","time":"10:50"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:50"},{"path":"\\/client-area\\/plugin","time":"10:50"},{"path":"\\/catalog","time":"10:50"},{"path":"\\/saas-marketplace","time":"10:51"},{"path":"\\/saas\\/chatbot-plugin","time":"10:51"},{"path":"\\/cart","time":"10:51"},{"path":"\\/checkout","time":"10:51"},{"path":"\\/order\\/instruction\\/26","time":"10:51"},{"path":"\\/client-area\\/invoices","time":"10:51"},{"path":"\\/client-area\\/plugin","time":"10:51"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:51"},{"path":"\\/saas-marketplace","time":"11:01"},{"path":"\\/saas\\/chatbot-plugin","time":"11:01"},{"path":"\\/cart","time":"11:01"},{"path":"\\/checkout","time":"11:01"},{"path":"\\/order\\/instruction\\/27","time":"11:01"},{"path":"\\/client-area","time":"11:01"},{"path":"\\/client-area\\/plugin","time":"11:01"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:01"},{"path":"\\/catalog","time":"11:26"},{"path":"\\/saas-marketplace","time":"11:26"},{"path":"\\/saas\\/chatbot-plugin","time":"11:26"},{"path":"\\/cart","time":"11:26"},{"path":"\\/checkout","time":"11:26"},{"path":"\\/order\\/instruction\\/28","time":"11:26"},{"path":"\\/client-area\\/invoices","time":"11:27"},{"path":"\\/client-area\\/plugin","time":"11:27"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:27"},{"path":"\\/client-area\\/plugin","time":"11:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:48"},{"path":"\\/client-area\\/plugin","time":"11:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:51"},{"path":"\\/client-area\\/plugin","time":"13:47"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:47"}]	2026-07-13 10:43:36	2026-07-13 13:47:06
758	pbOX1VyNzyRDBRVyQzdZW3IH15XMgN5ZIGGqZMbA	103.18.34.205	2026-07-13	[{"path":"\\/admin\\/dashboard","time":"10:44"},{"path":"\\/admin\\/plugin-customers","time":"10:44"},{"path":"\\/admin\\/plugin-management","time":"10:44"},{"path":"\\/admin\\/orders","time":"10:45"},{"path":"\\/admin\\/orders\\/25","time":"10:45"},{"path":"\\/admin\\/plugin-customers","time":"10:45"},{"path":"\\/admin\\/portfolios","time":"10:45"},{"path":"\\/admin\\/plugin-customers","time":"10:45"},{"path":"\\/admin\\/orders","time":"10:51"},{"path":"\\/admin\\/orders\\/26","time":"10:51"},{"path":"\\/admin\\/plugin-customers","time":"10:51"},{"path":"\\/admin\\/orders","time":"11:01"},{"path":"\\/admin\\/orders\\/27","time":"11:01"},{"path":"\\/admin\\/plugin-management","time":"11:01"},{"path":"\\/admin\\/plugin-customers","time":"11:01"},{"path":"\\/admin\\/orders","time":"11:26"},{"path":"\\/admin\\/orders\\/28","time":"11:26"},{"path":"\\/admin\\/products","time":"11:27"},{"path":"\\/admin\\/saas-management","time":"11:27"},{"path":"\\/admin\\/plugin-management","time":"11:27"},{"path":"\\/admin\\/plugin-customers","time":"11:27"}]	2026-07-13 10:44:18	2026-07-13 11:27:16
759	d7YAyuxpjuhQTXO69Dx2JXIJYyrVzyiFENuYyB1U	66.249.79.8	2026-07-13	[{"path":"\\/domain-registration","time":"15:18"}]	2026-07-13 15:18:34	2026-07-13 15:18:34
760	sTKINbpQm8ZagIckyWErtFfpstUZniidBNPhAUeI	23.27.145.132	2026-07-13	[{"path":"\\/","time":"15:48"}]	2026-07-13 15:48:01	2026-07-13 15:48:01
873	0BFaO4LhExzeoH7HZb2729cDHKaZeA2tT01A2JEm	182.2.44.137	2026-07-24	[{"path":"\\/","time":"22:04"}]	2026-07-24 22:04:45	2026-07-24 22:04:45
761	5PjFm9OVjNRUNRVDMBiFq9SvsAne2xnuNcSTYdDK	103.18.34.205	2026-07-14	[{"path":"\\/","time":"03:29"},{"path":"\\/login","time":"03:29"}]	2026-07-14 03:29:06	2026-07-14 03:29:09
762	uDaWssSvBijTkt7sVMOgi26zimk5SYaasHRXYtRD	103.18.34.205	2026-07-14	[{"path":"\\/login","time":"03:29"}]	2026-07-14 03:29:17	2026-07-14 03:29:17
888	ocnUT0iM8yoORZ94mRzGKCAhDRRfa3Kk4BvOY8oW	66.249.66.204	2026-07-30	[{"path":"\\/register","time":"02:26"}]	2026-07-30 02:26:50	2026-07-30 02:26:50
763	XimNnTNe5s8UBy91Xo6nXfVHcsphQN1usC6cdX4w	103.18.34.205	2026-07-14	[{"path":"\\/","time":"03:29"},{"path":"\\/client-area","time":"03:29"},{"path":"\\/client-area\\/plugin","time":"03:29"},{"path":"\\/client-area\\/plugin\\/manage","time":"03:29"},{"path":"\\/client-area\\/plugin","time":"03:29"},{"path":"\\/client-area\\/plugin\\/manage","time":"03:30"},{"path":"\\/client-area\\/plugin","time":"03:43"},{"path":"\\/client-area\\/plugin\\/manage","time":"03:44"},{"path":"\\/client-area\\/plugin","time":"03:52"},{"path":"\\/client-area\\/plugin\\/manage","time":"03:52"},{"path":"\\/catalog","time":"03:58"},{"path":"\\/saas-marketplace","time":"03:58"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"03:58"},{"path":"\\/cart","time":"03:58"},{"path":"\\/checkout","time":"03:58"},{"path":"\\/order\\/instruction\\/29","time":"03:58"}]	2026-07-14 03:29:24	2026-07-14 03:58:20
903	lb9UDCrri2sokojPAcZt5vd3H8hSYlQvJ7M7Aehs	173.252.87.36	2026-08-02	[{"path":"\\/","time":"06:55"}]	2026-08-02 06:55:58	2026-08-02 06:55:58
1250	gtFpysC4HMKMdulEEe944ZJM562A2rU64mCkv977	66.249.66.44	2026-09-01	[{"path":"\\/catalog","time":"22:00"}]	2026-09-01 22:00:23	2026-09-01 22:00:23
916	nylcpWoP42ECKHHFhxEWxrK7z34YU56wZxkMwMM9	103.147.8.19	2026-08-03	[{"path":"\\/","time":"11:37"},{"path":"\\/login","time":"11:37"}]	2026-08-03 11:37:48	2026-08-03 11:37:49
1072	Y3AuXFip1dAOWnQXFIHdRXlfWdskJ3KzsOHGvje2	82.158.131.175	2026-08-12	[{"path":"\\/","time":"18:37"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:38"}]	2026-08-12 18:37:51	2026-08-12 18:38:42
931	cjvGngmDZO8nULX7cEbmOoauLZ0nDBQXxhF4bfnz	182.8.255.1	2026-08-04	[{"path":"\\/","time":"09:41"},{"path":"\\/login","time":"09:41"}]	2026-08-04 09:41:45	2026-08-04 09:41:48
983	8ZjyL3MDfidangXHtitiU129lWzWGTWMpvM57pSC	182.8.255.157	2026-08-05	[{"path":"\\/login","time":"13:54"}]	2026-08-05 13:54:13	2026-08-05 13:54:13
994	kn4TE4ZS46w139i41rY8Xt21Zw5jbi8hKz9bCxu8	182.8.229.126	2026-08-06	[{"path":"\\/","time":"16:38"}]	2026-08-06 16:38:34	2026-08-06 16:38:35
995	mIKPQ5S2kknCVT8Tb0MUldfRid6z6Z2UtPQy8Phn	114.10.5.2	2026-08-06	[{"path":"\\/","time":"19:03"}]	2026-08-06 19:03:38	2026-08-06 19:03:38
1011	AshO2tcG8537c8jwdevtSNkLuGEuv2CZFfZtkxWS	114.10.20.237	2026-08-09	[{"path":"\\/","time":"17:45"}]	2026-08-09 17:45:07	2026-08-09 17:45:07
1027	OPEIqouw3wOgKNLHkMnbDcVsAn5sbhWkQtAyEfcV	103.18.34.207	2026-08-10	[{"path":"\\/","time":"18:03"},{"path":"\\/login","time":"18:03"}]	2026-08-10 18:03:16	2026-08-10 18:03:23
1156	ymqR8QTYI4jUeIxEowUhfY3YBJPhygKFxdQvcFQL	66.249.68.128	2026-08-22	[{"path":"\\/vps-hosting","time":"21:38"}]	2026-08-22 21:38:24	2026-08-22 21:38:24
1043	FcC2aCEmi3fMCrdtziKXiAk5vjBaAZWcqYfNlyD2	103.147.8.19	2026-08-11	[{"path":"\\/","time":"17:21"},{"path":"\\/client-area","time":"17:21"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:21"}]	2026-08-11 17:21:09	2026-08-11 17:21:19
1173	1ISIGXNOZsHqwpTD08hGhHDguDkn39boMEub9Dor	74.7.243.13	2026-08-24	[{"path":"\\/terms","time":"10:35"}]	2026-08-24 10:35:41	2026-08-24 10:35:41
1058	aLq3iogg87GGbZNXXEzuXG0rkfGUrChoII5ZSIYi	82.158.131.175	2026-08-12	[{"path":"\\/","time":"15:24"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:27"}]	2026-08-12 15:24:25	2026-08-12 15:27:55
1191	jnXsAGNenz0o20dueICmXyH0A67SD8pXYpPurcPC	52.167.144.219	2026-08-26	[{"path":"\\/about-us","time":"21:31"}]	2026-08-26 21:31:51	2026-08-26 21:31:53
1207	f2AF4thFjjPbgL65O86PJG53zc3oZDRsrS2B3t4U	182.10.98.70	2026-08-28	[{"path":"\\/","time":"23:50"}]	2026-08-28 23:50:27	2026-08-28 23:50:27
1222	sCvggslLlJ7saRCimyfwSbZ6FKHU9eTIGi31bLJN	118.137.108.50	2026-08-31	[{"path":"\\/","time":"11:47"}]	2026-08-31 11:47:28	2026-08-31 11:47:28
1236	UZ9xnH12ZhjEPs0nqtckXlUcpKlSyNxoZcGY0Nfs	103.147.8.141	2026-09-01	[{"path":"\\/","time":"08:28"},{"path":"\\/login","time":"08:28"}]	2026-09-01 08:28:17	2026-09-01 08:28:30
1264	BbLOOlOGjmCazhu8J4wTR0rF08TznoVG9ABIl8hO	182.253.131.1	2026-09-03	[{"path":"\\/","time":"14:00"},{"path":"\\/client-area","time":"14:00"},{"path":"\\/client-area\\/products","time":"14:00"},{"path":"\\/client-area\\/domain","time":"14:00"},{"path":"\\/client-area\\/hosting","time":"14:01"},{"path":"\\/client-area\\/vps","time":"14:01"},{"path":"\\/client-area\\/tickets","time":"14:01"},{"path":"\\/","time":"14:02"},{"path":"\\/client-area","time":"14:02"},{"path":"\\/catalog","time":"14:03"}]	2026-09-03 14:00:33	2026-09-03 14:03:18
1277	95g2JyS901kN467dP8CVTJ28NGKFtbxXTqv2V1HR	66.249.66.42	2026-09-05	[{"path":"\\/saas-marketplace","time":"01:41"}]	2026-09-05 01:41:53	2026-09-05 01:41:53
1291	k75wILgObLaInS3sCWRfOmkjKiCGKq0uF0517JY8	103.147.8.141	2026-09-07	[{"path":"\\/","time":"12:09"}]	2026-09-07 12:09:54	2026-09-07 12:09:54
874	WhR51yMtoYS5I19mwlWTxpHttdAT2yLlT9IiGXQp	52.167.144.213	2026-07-25	[{"path":"\\/","time":"06:46"}]	2026-07-25 06:46:17	2026-07-25 06:46:17
889	OtjNeHmD83mkBn7eQzJ7nxdWR23JPxmYpktNz5Up	52.167.144.237	2026-07-30	[{"path":"\\/domain-registration","time":"07:31"}]	2026-07-30 07:31:32	2026-07-30 07:31:32
904	IuLlTBpwVDPx5F3r0H5PR5IA0oDX68SMzI7ASSdA	17.22.253.190	2026-08-02	[{"path":"\\/domain-registration","time":"13:36"}]	2026-08-02 13:36:21	2026-08-02 13:36:21
1174	h2gpvHFI5voyitxHIhBnLysyzjImP0Pmi4PpJmVb	110.136.62.87	2026-08-24	[{"path":"\\/","time":"16:28"},{"path":"\\/services","time":"16:29"},{"path":"\\/catalog","time":"16:29"},{"path":"\\/saas-marketplace","time":"16:30"}]	2026-08-24 16:28:52	2026-08-24 16:30:18
932	tlYsGbfMMl04dGbfGxEVMvMJdsz4js0Yy9MajXi3	182.8.255.1	2026-08-04	[{"path":"\\/","time":"09:46"},{"path":"\\/client-area","time":"09:46"},{"path":"\\/client-area\\/profile","time":"09:46"}]	2026-08-04 09:46:26	2026-08-04 09:46:38
1192	x8mW4IRn83IN1D4ul5soG3XBi3H8J4zpap7jXZ6C	66.249.71.97	2026-08-27	[{"path":"\\/","time":"06:32"}]	2026-08-27 06:32:48	2026-08-27 06:32:49
1208	beajlgvqgWquwrepAPmTWxyXTuUY3EG1hM5yWeWS	66.249.66.71	2026-08-29	[{"path":"\\/saas-marketplace","time":"01:05"}]	2026-08-29 01:05:15	2026-08-29 01:05:15
984	JINSRSt0JwcsTHxyrixQZXQZVVV0HrWnV81eNSrg	182.8.255.157	2026-08-05	[{"path":"\\/client-area\\/plugin\\/manage","time":"13:54"},{"path":"\\/client-area\\/domain","time":"16:00"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:00"},{"path":"\\/client-area\\/plugin","time":"16:01"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:02"},{"path":"\\/client-area\\/plugin","time":"16:05"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:05"}]	2026-08-05 13:54:55	2026-08-05 16:05:48
996	bRmJKDIP6Wt8vQl0cift1NJkrkmHU3yPxyp4UhhY	182.253.150.7	2026-08-06	[{"path":"\\/","time":"19:05"}]	2026-08-06 19:05:04	2026-08-06 19:05:04
1012	Lc1tQkQqJqFvBkGzXLZSU1TqbWJIaYJyhnQ6QcC2	66.249.68.129	2026-08-10	[{"path":"\\/order\\/cpanel","time":"10:45"}]	2026-08-10 10:45:18	2026-08-10 10:45:18
917	GNKpKcnLOGmylKqpKWMffK2GrxftDyAhmFwFhwIu	103.147.8.19	2026-08-03	[{"path":"\\/","time":"11:38"},{"path":"\\/client-area","time":"11:38"},{"path":"\\/client-area\\/hosting","time":"11:38"},{"path":"\\/catalog","time":"11:38"},{"path":"\\/saas-marketplace","time":"11:38"},{"path":"\\/saas\\/chatbot-plugin","time":"11:38"},{"path":"\\/cart","time":"11:38"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"11:38"},{"path":"\\/cart","time":"11:38"},{"path":"\\/checkout","time":"11:38"},{"path":"\\/order\\/instruction\\/48","time":"11:38"},{"path":"\\/client-area","time":"11:38"},{"path":"\\/client-area\\/plugin","time":"11:38"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:40"},{"path":"\\/client-area\\/plugin","time":"11:40"}]	2026-08-03 11:38:03	2026-08-03 11:40:54
1223	FnAlt6lqnNCQ9wMTH9CS3EowPOPgOQLGeKk11Q1S	103.147.8.141	2026-08-31	[{"path":"\\/","time":"18:17"},{"path":"\\/login","time":"18:17"}]	2026-08-31 18:17:19	2026-08-31 18:17:38
1028	lA7wKh0C3E6sgcHFWCx8Z9xtyRMzcsuxRwECUM9C	103.18.34.207	2026-08-10	[{"path":"\\/","time":"18:03"},{"path":"\\/client-area","time":"18:03"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:03"}]	2026-08-10 18:03:46	2026-08-10 18:03:58
1044	ruHg3pCxZQ3ip3DYthFhFPbbL9QqxdnkOm7IW4eh	103.147.8.19	2026-08-11	[{"path":"\\/","time":"17:24"},{"path":"\\/login","time":"17:24"}]	2026-08-11 17:24:34	2026-08-11 17:24:36
1059	m1obGYEf5unm6HC18a5uO6wIqCzP3TpJZMdkWzA2	82.158.131.175	2026-08-12	[{"path":"\\/client-area\\/plugin\\/manage","time":"15:30"}]	2026-08-12 15:30:36	2026-08-12 15:30:36
1073	Azx0NCfBGas0lc7fY5za1IYGUA6k4S8xCSPJYleK	52.167.144.23	2026-08-12	[{"path":"\\/","time":"20:04"}]	2026-08-12 20:04:57	2026-08-12 20:04:57
1157	kWHaSrTmR3EV2LTmJR3psflQ7J9qz9msqgL4CQA7	66.249.66.34	2026-08-22	[{"path":"\\/order\\/vps","time":"22:46"}]	2026-08-22 22:46:40	2026-08-22 22:46:40
1237	5bdzZoutHdb6yETSrQhW86wUzdiSTGUwnulGtWPA	103.147.8.141	2026-09-01	[{"path":"\\/","time":"08:28"},{"path":"\\/client-area","time":"08:28"},{"path":"\\/client-area\\/plugin\\/manage","time":"08:28"}]	2026-09-01 08:28:34	2026-09-01 08:28:43
1251	9KWOFCEZlRZTmDGfZfXftRnEQKVatyYfFQaOkhbI	40.77.167.28	2026-09-02	[{"path":"\\/order\\/cpanel","time":"04:48"}]	2026-09-02 04:48:16	2026-09-02 04:48:16
1265	jPTpt1gjr5L9UMbjUrWX2bSDL7IWSqtgoXcev9U8	66.249.71.172	2026-09-03	[{"path":"\\/faq","time":"21:06"}]	2026-09-03 21:06:19	2026-09-03 21:06:19
1278	21FgnWXAx88UXLEaHp2zv0xCKRAzvZwg5waThK9m	66.249.79.36	2026-09-05	[{"path":"\\/register","time":"19:22"}]	2026-09-05 19:22:57	2026-09-05 19:22:57
764	B8OUXk3Jg0AdjlaDI1cAl3hYbXYUTE197VHmPeTS	103.18.34.205	2026-07-14	[{"path":"\\/admin\\/dashboard","time":"03:58"},{"path":"\\/admin\\/orders","time":"03:58"},{"path":"\\/admin\\/orders\\/29","time":"03:58"},{"path":"\\/client-area\\/invoices","time":"03:58"},{"path":"\\/client-area\\/plugin\\/manage","time":"03:59"},{"path":"\\/client-area\\/plugin","time":"03:59"},{"path":"\\/catalog","time":"03:59"},{"path":"\\/admin\\/plugin-customers","time":"04:00"},{"path":"\\/saas-marketplace","time":"04:00"},{"path":"\\/saas\\/chatbot-plugin","time":"04:00"},{"path":"\\/cart","time":"04:00"},{"path":"\\/checkout","time":"04:00"},{"path":"\\/order\\/instruction\\/30","time":"04:00"},{"path":"\\/admin\\/orders","time":"04:00"},{"path":"\\/admin\\/orders\\/30","time":"04:00"},{"path":"\\/client-area\\/invoices","time":"04:00"},{"path":"\\/client-area\\/plugin","time":"04:00"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:01"},{"path":"\\/client-area\\/plugin","time":"04:06"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:06"},{"path":"\\/client-area\\/plugin","time":"04:07"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:07"},{"path":"\\/client-area\\/plugin","time":"04:07"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:08"},{"path":"\\/admin\\/plugin-customers","time":"04:40"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:41"},{"path":"\\/saas-marketplace","time":"04:41"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"04:41"},{"path":"\\/cart","time":"04:41"},{"path":"\\/checkout","time":"04:41"},{"path":"\\/order\\/instruction\\/31","time":"04:41"},{"path":"\\/admin\\/orders","time":"04:41"},{"path":"\\/admin\\/orders\\/31","time":"04:41"},{"path":"\\/client-area\\/invoices","time":"04:41"},{"path":"\\/client-area\\/plugin","time":"04:41"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:42"},{"path":"\\/client-area\\/plugin","time":"04:51"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:51"},{"path":"\\/client-area\\/plugin","time":"04:54"},{"path":"\\/client-area\\/plugin\\/manage","time":"04:59"},{"path":"\\/client-area\\/plugin","time":"05:02"},{"path":"\\/client-area\\/plugin\\/manage","time":"05:02"},{"path":"\\/client-area\\/plugin","time":"05:06"},{"path":"\\/client-area\\/plugin\\/manage","time":"05:06"},{"path":"\\/client-area\\/plugin","time":"05:07"},{"path":"\\/client-area\\/plugin\\/manage","time":"05:14"},{"path":"\\/client-area\\/plugin","time":"05:14"},{"path":"\\/client-area\\/plugin\\/manage","time":"05:14"},{"path":"\\/admin\\/orders\\/31","time":"06:12"},{"path":"\\/client-area\\/plugin\\/manage","time":"06:22"},{"path":"\\/client-area\\/plugin","time":"06:48"},{"path":"\\/catalog","time":"06:48"},{"path":"\\/client-area","time":"06:48"},{"path":"\\/catalog","time":"06:48"},{"path":"\\/saas-marketplace","time":"06:48"},{"path":"\\/saas\\/chatbot-plugin","time":"06:48"},{"path":"\\/cart","time":"06:49"},{"path":"\\/checkout","time":"06:49"},{"path":"\\/order\\/instruction\\/32","time":"06:49"},{"path":"\\/admin\\/orders","time":"06:49"},{"path":"\\/admin\\/orders\\/32","time":"06:49"},{"path":"\\/client-area\\/invoices","time":"06:49"},{"path":"\\/client-area\\/plugin\\/manage","time":"06:49"},{"path":"\\/client-area\\/plugin","time":"06:49"},{"path":"\\/client-area\\/plugin\\/manage","time":"06:50"},{"path":"\\/client-area\\/plugin","time":"08:08"},{"path":"\\/client-area\\/plugin\\/manage","time":"08:08"},{"path":"\\/client-area\\/hosting","time":"08:11"},{"path":"\\/client-area\\/saas","time":"08:11"},{"path":"\\/admin\\/orders","time":"09:34"},{"path":"\\/admin\\/orders\\/33","time":"09:34"},{"path":"\\/admin\\/orders","time":"09:34"},{"path":"\\/admin\\/orders\\/34","time":"09:34"},{"path":"\\/admin\\/orders","time":"09:34"},{"path":"\\/admin\\/products","time":"09:37"},{"path":"\\/admin\\/portfolios","time":"09:37"},{"path":"\\/admin\\/plugin-customers","time":"09:42"},{"path":"\\/admin\\/plugin-management","time":"09:42"},{"path":"\\/admin\\/saas-management","time":"09:42"},{"path":"\\/admin\\/products","time":"09:42"},{"path":"\\/admin\\/orders","time":"09:42"},{"path":"\\/admin\\/monitoring","time":"09:42"},{"path":"\\/admin\\/dashboard","time":"09:42"},{"path":"\\/admin\\/monitoring","time":"09:42"},{"path":"\\/admin\\/chatbot\\/history","time":"09:42"},{"path":"\\/admin\\/chatbot\\/responses","time":"09:42"},{"path":"\\/admin\\/chatbot\\/live","time":"09:42"},{"path":"\\/admin\\/plugin-customers","time":"09:42"},{"path":"\\/admin\\/plugin-management","time":"09:42"},{"path":"\\/admin\\/saas-management","time":"09:42"},{"path":"\\/client-area\\/plugin","time":"09:43"},{"path":"\\/client-area\\/plugin\\/manage","time":"09:43"},{"path":"\\/admin\\/saas-management","time":"10:08"},{"path":"\\/admin\\/orders","time":"10:08"},{"path":"\\/admin\\/orders\\/36","time":"11:30"},{"path":"\\/admin\\/orders","time":"11:30"},{"path":"\\/admin\\/orders\\/35","time":"11:30"},{"path":"\\/admin\\/orders","time":"11:30"},{"path":"\\/client-area\\/plugin","time":"11:43"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:43"},{"path":"\\/client-area\\/plugin","time":"12:31"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:31"},{"path":"\\/client-area\\/plugin","time":"12:58"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:59"},{"path":"\\/admin\\/plugin-customers","time":"13:03"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:03"},{"path":"\\/client-area\\/plugin","time":"13:03"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:03"},{"path":"\\/client-area\\/plugin","time":"13:04"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:05"},{"path":"\\/client-area\\/plugin","time":"13:05"},{"path":"\\/client-area\\/saas","time":"13:06"},{"path":"\\/client-area\\/vps","time":"13:06"},{"path":"\\/client-area\\/plugin","time":"13:06"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:06"},{"path":"\\/admin\\/plugin-customers","time":"13:17"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:17"},{"path":"\\/saas-marketplace","time":"13:17"},{"path":"\\/saas\\/chatbot-plugin","time":"13:17"},{"path":"\\/cart","time":"13:17"},{"path":"\\/checkout","time":"13:17"},{"path":"\\/order\\/instruction\\/37","time":"13:17"},{"path":"\\/admin\\/orders","time":"13:20"},{"path":"\\/admin\\/orders\\/37","time":"13:20"},{"path":"\\/client-area\\/invoices","time":"13:21"},{"path":"\\/client-area\\/plugin","time":"13:21"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:21"},{"path":"\\/client-area\\/plugin","time":"13:25"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:25"},{"path":"\\/client-area\\/plugin","time":"13:26"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:26"},{"path":"\\/client-area\\/plugin","time":"13:27"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:27"},{"path":"\\/client-area\\/plugin","time":"13:46"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:46"},{"path":"\\/client-area\\/plugin","time":"13:56"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:56"},{"path":"\\/client-area\\/plugin","time":"14:02"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:02"},{"path":"\\/client-area\\/products","time":"14:04"},{"path":"\\/client-area\\/plugin","time":"14:04"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:05"},{"path":"\\/client-area\\/plugin","time":"14:13"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:17"},{"path":"\\/admin\\/monitoring","time":"14:21"},{"path":"\\/admin\\/orders","time":"14:21"},{"path":"\\/admin\\/orders\\/38","time":"14:21"},{"path":"\\/admin\\/orders","time":"14:21"},{"path":"\\/client-area\\/plugin","time":"14:25"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:25"},{"path":"\\/client-area\\/plugin","time":"14:42"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:58"},{"path":"\\/catalog","time":"15:30"},{"path":"\\/saas-marketplace","time":"15:30"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"15:30"},{"path":"\\/cart","time":"15:30"},{"path":"\\/checkout","time":"15:30"},{"path":"\\/order\\/instruction\\/39","time":"15:30"},{"path":"\\/admin\\/orders","time":"15:30"},{"path":"\\/admin\\/orders\\/39","time":"15:30"},{"path":"\\/client-area\\/invoices","time":"15:30"},{"path":"\\/client-area\\/plugin","time":"15:30"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:38"},{"path":"\\/client-area\\/plugin","time":"16:00"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:00"},{"path":"\\/client-area\\/plugin","time":"16:18"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:19"},{"path":"\\/client-area\\/plugin","time":"23:54"},{"path":"\\/client-area\\/plugin\\/manage","time":"23:54"},{"path":"\\/client-area\\/plugin","time":"23:54"},{"path":"\\/client-area\\/plugin\\/manage","time":"23:54"},{"path":"\\/client-area\\/plugin","time":"23:56"}]	2026-07-14 03:58:39	2026-07-14 23:56:27
875	cKbVslVF5Fu4YGX49sExuf5b6gyMSKU3EfXOQvGt	66.249.79.7	2026-07-26	[{"path":"\\/saas-marketplace","time":"06:39"}]	2026-07-26 06:39:38	2026-07-26 06:39:38
890	qowBKLrbWD7HD6a8v27tmoLKpMS90vFoIkIoXjNS	103.19.109.22	2026-07-30	[{"path":"\\/","time":"10:16"}]	2026-07-30 10:16:15	2026-07-30 10:16:15
905	1d6qCGQih2YPJ8Va02GXmpYehAudMxy8ZfcUwbE8	66.249.68.129	2026-08-03	[{"path":"\\/saas-marketplace","time":"07:27"}]	2026-08-03 07:27:15	2026-08-03 07:27:15
918	H6HtWcQZsEl8xkT5bESLDFW6tgyjIIher57TcTEf	103.147.8.19	2026-08-03	[{"path":"\\/login","time":"12:27"}]	2026-08-03 12:27:13	2026-08-03 12:27:13
933	Dek2sF63b6r4PbFIP0jx5iZvXyaL6dAbQYzYFOWK	182.8.255.1	2026-08-04	[{"path":"\\/","time":"09:47"},{"path":"\\/client-area","time":"09:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:11"}]	2026-08-04 09:47:14	2026-08-04 10:11:17
997	1aeTI7HDhA4xihZTtHGaV26EpDSsUk0wNK8z5LFR	40.77.167.77	2026-08-07	[{"path":"\\/","time":"00:35"}]	2026-08-07 00:35:42	2026-08-07 00:35:42
1013	K0AnXAAtJy7rhJVDx5kEOCAsFH4FDI6Q1BgwmMVi	103.18.34.207	2026-08-10	[{"path":"\\/","time":"11:43"},{"path":"\\/login","time":"11:43"}]	2026-08-10 11:43:18	2026-08-10 11:43:23
980	1WfdgybQOQ0RGeELUjKhDebjPJhyimbsbONbGC2m	140.213.251.248	2026-08-05	[{"path":"\\/","time":"10:29"},{"path":"\\/client-area","time":"10:29"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:29"},{"path":"\\/client-area\\/domain","time":"12:54"},{"path":"\\/client-area\\/hosting","time":"12:54"},{"path":"\\/client-area\\/domain","time":"12:54"},{"path":"\\/client-area\\/services\\/1\\/manage","time":"12:54"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:58"},{"path":"\\/","time":"14:55"},{"path":"\\/client-area","time":"14:56"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:56"},{"path":"\\/","time":"16:19"},{"path":"\\/client-area","time":"16:19"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:19"},{"path":"\\/","time":"21:58"},{"path":"\\/client-area","time":"21:58"},{"path":"\\/client-area\\/plugin\\/manage","time":"21:58"}]	2026-08-05 10:29:42	2026-08-05 21:58:47
1175	iu1TdxmEwj6569fZQKTC86D7MEDvgDUSr8kgiEF7	179.65.205.180	2026-08-24	[{"path":"\\/vps-hosting","time":"17:34"},{"path":"\\/order\\/vps","time":"17:39"}]	2026-08-24 17:34:26	2026-08-24 17:39:22
1029	rCHRpfi5i7hPXmC5EBZ8NZ9tY8S61gbjUbNcaaub	182.8.229.101	2026-08-10	[{"path":"\\/","time":"18:15"},{"path":"\\/register","time":"18:15"},{"path":"\\/login","time":"18:15"}]	2026-08-10 18:15:31	2026-08-10 18:15:36
1193	TZpwCj2Rfzy786z8O3j37rABzEiSftDv9SGUeMhd	182.8.229.23	2026-08-27	[{"path":"\\/","time":"09:00"}]	2026-08-27 09:00:53	2026-08-27 09:00:53
1045	9uMYCZ45JmzgrTQpQwUba8D28YGxMMntqjKiY9Cx	103.147.8.19	2026-08-11	[{"path":"\\/","time":"17:24"},{"path":"\\/client-area","time":"17:24"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:24"}]	2026-08-11 17:24:40	2026-08-11 17:24:45
1060	VRk5278i1P8QcsOUPwsdVPEgKviRjbYULZIZ4vmY	82.158.131.175	2026-08-12	[{"path":"\\/login","time":"15:35"}]	2026-08-12 15:35:52	2026-08-12 15:35:52
1209	Vf0pe3g5SHXz1mAHz9zTZTcnLOZ1rnto4tAjwezP	66.249.66.197	2026-08-29	[{"path":"\\/domain-registration","time":"06:01"}]	2026-08-29 06:01:53	2026-08-29 06:01:53
1074	4acJr2Bb8hZm7uNQZLxVmmf3ym5rUemXWK3mcd4A	103.36.8.105	2026-08-12	[{"path":"\\/","time":"20:07"},{"path":"\\/login","time":"20:38"}]	2026-08-12 20:07:57	2026-08-12 20:38:20
1082	HrUTalF0Vnc6XabYtnfLrwz6fvBkwf0xvzddjHYU	82.158.131.175	2026-08-13	[{"path":"\\/admin\\/dashboard","time":"13:05"},{"path":"\\/admin\\/orders","time":"13:05"},{"path":"\\/admin\\/products","time":"13:05"},{"path":"\\/admin\\/saas-management","time":"13:05"},{"path":"\\/admin\\/plugin-management","time":"13:05"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"13:05"},{"path":"\\/admin\\/plugin-management","time":"13:05"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"13:05"},{"path":"\\/admin\\/plugin-management","time":"13:06"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"13:06"},{"path":"\\/admin\\/plugin-management","time":"13:06"},{"path":"\\/saas-marketplace","time":"13:06"},{"path":"\\/admin\\/plugin-management","time":"13:33"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"13:33"},{"path":"\\/admin\\/plugin-management","time":"13:33"},{"path":"\\/admin\\/plugin\\/create","time":"13:33"},{"path":"\\/admin\\/plugin-management","time":"13:33"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"13:34"},{"path":"\\/saas-marketplace","time":"13:35"},{"path":"\\/saas\\/chatbot-plugin","time":"13:35"},{"path":"\\/admin\\/plugin-management","time":"13:35"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"13:35"},{"path":"\\/admin\\/plugin-management","time":"13:35"},{"path":"\\/saas\\/chatbot-plugin","time":"13:35"}]	2026-08-13 13:05:03	2026-08-13 13:35:55
1158	6LtrQx01Jl93PpTRvzMn1zCD2XVYedCyS0RKujaf	66.249.71.96	2026-08-22	[{"path":"\\/order\\/cpanel","time":"23:00"}]	2026-08-22 23:00:48	2026-08-22 23:00:48
1279	EJztgTP74vyFEdAVx3uNCKgwJo9b2s3R7gDuM9QR	66.249.71.171	2026-09-06	[{"path":"\\/login","time":"03:22"}]	2026-09-06 03:22:13	2026-09-06 03:22:13
1238	3aH3VhBATF3KCTOQVkpk6xU3Va9o60oZUvD8WpC3	103.147.8.141	2026-09-01	[{"path":"\\/","time":"08:32"},{"path":"\\/login","time":"08:32"}]	2026-09-01 08:32:45	2026-09-01 08:32:47
1224	HTMC9nt6glJPBzn2DmmDDAswlyYr8XFmxiI4EJHR	103.147.8.141	2026-08-31	[{"path":"\\/","time":"18:17"},{"path":"\\/client-area","time":"18:17"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:18"}]	2026-08-31 18:17:50	2026-08-31 18:18:02
1252	L86qcRPkEL0Zx55ZfCVW0k5nGDfrh2MdTje9Y4nX	66.249.79.36	2026-09-02	[{"path":"\\/about-us","time":"04:58"}]	2026-09-02 04:58:51	2026-09-02 04:58:51
1266	PCpXvcxtUEXrS0k5klsaBVChSHC6H2Fga06S34Yt	74.7.228.174	2026-09-03	[{"path":"\\/cpanel-hosting","time":"21:24"}]	2026-09-03 21:24:59	2026-09-03 21:24:59
765	GsIc349XkPmreNXzdFkt96zpBqDj1cOjL5705Vco	202.47.162.58	2026-07-14	[{"path":"\\/","time":"09:19"},{"path":"\\/register","time":"09:19"}]	2026-07-14 09:19:11	2026-07-14 09:19:25
766	43uLJHGpO6etEUojp5DxnZfqXzpcvumWHfmozhxT	202.47.162.58	2026-07-14	[{"path":"\\/login","time":"09:21"}]	2026-07-14 09:21:49	2026-07-14 09:21:49
876	uwtT8eAwTOmkSmkHy8yXGQhUn4V2VkQA9ooT0Zqk	182.8.255.135	2026-07-27	[{"path":"\\/","time":"06:59"}]	2026-07-27 06:59:48	2026-07-27 06:59:49
891	JvAa4OGFTsRf8gJUecXGO94tYS3HUlhZel1foZk6	114.10.148.119	2026-07-30	[{"path":"\\/","time":"10:47"}]	2026-07-30 10:47:32	2026-07-30 10:47:32
1030	X2Zieg6CLf8cqsgrQEiXfwtjxDGYBKfJhWZlPi0M	182.8.229.101	2026-08-10	[{"path":"\\/","time":"18:16"},{"path":"\\/client-area","time":"18:16"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:16"}]	2026-08-10 18:16:46	2026-08-10 18:16:56
1046	s4BLnMF4ZOq2bgDcjh1FfCfBgLHVqzrHymlDpUML	66.249.71.128	2026-08-11	[{"path":"\\/","time":"18:32"}]	2026-08-11 18:32:39	2026-08-11 18:32:39
1253	c2sWIaiA9klRx3HJehg9iuIZJrULzaHExVAqYKao	173.252.87.1	2026-09-02	[{"path":"\\/","time":"10:43"}]	2026-09-02 10:43:08	2026-09-02 10:43:08
1061	QQNBYvXdsKHnbyouBlAwbBaLum3sP6Lesja3dQqi	82.158.131.175	2026-08-12	[{"path":"\\/client-area","time":"15:36"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:37"}]	2026-08-12 15:36:05	2026-08-12 15:37:14
1075	udSxRFVUZ2NliFoZYCOjl8PJ1n3eujWtNxU6sLWi	82.158.131.175	2026-08-12	[{"path":"\\/client-area\\/plugin\\/manage","time":"21:48"},{"path":"\\/login","time":"21:49"}]	2026-08-12 21:48:26	2026-08-12 21:49:39
906	54uQIIMUxladGD2kWlpGwDoN0ICp2LU0BQGJXes9	103.147.8.19	2026-08-03	[{"path":"\\/","time":"09:53"},{"path":"\\/login","time":"09:54"},{"path":"\\/register","time":"09:54"},{"path":"\\/login","time":"09:54"},{"path":"\\/register","time":"09:54"},{"path":"\\/login","time":"09:58"},{"path":"\\/register","time":"09:58"},{"path":"\\/","time":"09:59"},{"path":"\\/login","time":"09:59"},{"path":"\\/register","time":"10:00"},{"path":"\\/","time":"10:38"}]	2026-08-03 09:53:55	2026-08-03 10:38:02
919	6qn1b3x7dUlulFiDNUgRaMI1BsVU47TIC73Vpykj	182.253.150.6	2026-08-03	[{"path":"\\/","time":"12:27"}]	2026-08-03 12:27:39	2026-08-03 12:27:39
1267	uh80lemWOuqIxba3mVIXQDZ0CdjYFo4s1308lwYT	182.253.228.98	2026-09-03	[{"path":"\\/","time":"22:13"}]	2026-09-03 22:13:05	2026-09-03 22:13:05
934	Hg5YkZVZnUZ83ZVEG0eYbCx564mN6dxrXhmAi2ee	103.147.8.19	2026-08-04	[{"path":"\\/","time":"09:50"},{"path":"\\/login","time":"09:50"},{"path":"\\/forgot-password","time":"09:50"}]	2026-08-04 09:50:16	2026-08-04 09:50:24
985	0y9x2nLTzqUD1vn7nMswMe4qeZE3Oto6o0FA7lzL	66.249.68.129	2026-08-05	[{"path":"\\/order\\/cpanel","time":"16:03"}]	2026-08-05 16:03:53	2026-08-05 16:03:53
998	ybghH9aDm7kYXqL0qPBn9JXBn6ggztmmc9764Sz7	103.18.34.205	2026-08-07	[{"path":"\\/","time":"11:01"}]	2026-08-07 11:01:35	2026-08-07 11:01:35
1083	zRj1n4z5vM7Myddr0jUuDZKdpB10S341G2bv6Pep	82.158.131.175	2026-08-13	[{"path":"\\/","time":"15:29"},{"path":"\\/saas-marketplace","time":"16:09"},{"path":"\\/saas\\/chatbot-plugin","time":"16:09"},{"path":"\\/","time":"17:14"}]	2026-08-13 15:29:06	2026-08-13 17:14:00
1159	efyQazlYS0Imor9RC3o4DOpLaSTwkHtPtTpf99ze	66.249.66.33	2026-08-22	[{"path":"\\/order\\/saas","time":"23:11"}]	2026-08-22 23:11:06	2026-08-22 23:11:06
1014	HbLbAMVpxZGvP73XqIdQH421I5MwwtJTlFhpHgEP	103.18.34.207	2026-08-10	[{"path":"\\/","time":"11:43"},{"path":"\\/client-area","time":"11:43"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:43"},{"path":"\\/","time":"12:45"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:54"}]	2026-08-10 11:43:40	2026-08-10 12:54:33
1280	MdxtSksw4IGBDUrmxy7eOLau4EvYmwLKCmeUPaS3	66.249.71.170	2026-09-06	[{"path":"\\/login","time":"03:22"}]	2026-09-06 03:22:24	2026-09-06 03:22:24
1176	iqnc8NcoBDxiA0Fvnw1LBtgvpcKpop8UjC5q62Ua	66.249.68.128	2026-08-24	[{"path":"\\/login","time":"22:06"}]	2026-08-24 22:06:08	2026-08-24 22:06:09
1194	OCjyC1gRXDJVq1CHw6XDb1VnpKrhghAHEx5Af0q8	66.249.64.172	2026-08-27	[{"path":"\\/register","time":"17:05"}]	2026-08-27 17:05:48	2026-08-27 17:05:49
1210	AnhDUnwcpkLxJwY9yjOd0iu6pIwQYOQ8qAhkLAPj	66.249.64.170	2026-08-29	[{"path":"\\/","time":"09:05"}]	2026-08-29 09:05:24	2026-08-29 09:05:24
1225	XvS8pCHI9oC3NpsIaaUWkqdlC8GmEiWlSRhp8gBZ	103.147.8.141	2026-08-31	[{"path":"\\/","time":"19:40"},{"path":"\\/login","time":"19:40"}]	2026-08-31 19:40:10	2026-08-31 19:40:13
1239	DBeYtn6mSGeuAoWskXlDWToDKSvxUqEVWAUQ6gm3	103.147.8.141	2026-09-01	[{"path":"\\/","time":"08:33"},{"path":"\\/client-area","time":"08:33"},{"path":"\\/client-area\\/hosting","time":"08:33"},{"path":"\\/client-area\\/plugin\\/manage","time":"08:35"}]	2026-09-01 08:33:07	2026-09-01 08:35:23
781	nIG8POgZQtwuE0OABi3OE9XyOVSm10mjJCxIj0eQ	54.87.242.174	2026-07-14	[{"path":"\\/client-area\\/domain","time":"10:33"}]	2026-07-14 10:33:53	2026-07-14 10:33:53
768	2w7LofxdhoTa0X1ozsWfDDrIFqRH7PBLLvLsZ6g9	103.147.8.19	2026-07-14	[{"path":"\\/","time":"10:12"},{"path":"\\/login","time":"10:12"}]	2026-07-14 10:12:43	2026-07-14 10:12:48
769	ttTitdy2KmtfaEopzNkIjRTqg2S8INS3EaQhSD5o	103.147.8.19	2026-07-14	[{"path":"\\/login","time":"10:12"}]	2026-07-14 10:12:54	2026-07-14 10:12:54
773	7zT38O00yjlepcs2Mge4RWNZqIV6Lmp18yFvTBSw	34.235.144.233	2026-07-14	[{"path":"\\/catalog","time":"10:17"}]	2026-07-14 10:17:03	2026-07-14 10:17:03
774	205tAEmxwY5zKONk7ZlPlAUZhhV7UbhdqsrQtHYQ	54.89.239.56	2026-07-14	[{"path":"\\/","time":"10:17"}]	2026-07-14 10:17:08	2026-07-14 10:17:08
771	jEXAUVKUmfZjSaVuqH3fc1Y6UIFGvGCdGnv21kgs	13.223.74.5	2026-07-14	[{"path":"\\/catalog","time":"10:14"}]	2026-07-14 10:14:55	2026-07-14 10:14:55
772	3OXP3ngyN7B5dNzHdbhoQjF4Ms8G8M5E1DcNLbY8	13.217.114.59	2026-07-14	[{"path":"\\/cart","time":"10:15"}]	2026-07-14 10:15:34	2026-07-14 10:15:35
776	X6Bg81UFr3GNwzkbTG3oT0re6SX0JRQNMP4HWgEQ	3.87.117.173	2026-07-14	[{"path":"\\/client-area\\/invoices","time":"10:17"}]	2026-07-14 10:17:59	2026-07-14 10:17:59
775	72YhqMWJz06h6eeeZ7SihHGVaSAjUPQ36FU3ogxo	52.90.38.120	2026-07-14	[{"path":"\\/client-area","time":"10:17"}]	2026-07-14 10:17:33	2026-07-14 10:17:33
777	FueLGzo7kDoBgfy60laPd3YUIofzcIHuPcO5wxhl	54.162.128.164	2026-07-14	[{"path":"\\/saas\\/monitoring-visitor-plugin","time":"10:18"}]	2026-07-14 10:18:55	2026-07-14 10:18:55
778	VINrtyZQiYvkBEfg5ae1psfLt86bpddpeI9a21fE	100.31.56.197	2026-07-14	[{"path":"\\/checkout","time":"10:19"}]	2026-07-14 10:19:04	2026-07-14 10:19:04
779	e5yJdnEOujA3MvveNLbuCuIWB6v5mVwUBltPcMfp	54.234.75.1	2026-07-14	[{"path":"\\/client-area\\/plugin","time":"10:19"}]	2026-07-14 10:19:18	2026-07-14 10:19:18
780	mIgNIgCEsOmZF34vkfRgGHdiGKbwQ8IfelNgw7wV	54.89.239.56	2026-07-14	[{"path":"\\/client-area\\/invoices","time":"10:20"}]	2026-07-14 10:20:25	2026-07-14 10:20:25
782	tDC2nQmTht4w8OAhKUF17DIlGwNOthwlwpuptVOs	34.229.197.22	2026-07-14	[{"path":"\\/client-area\\/domain","time":"10:38"}]	2026-07-14 10:38:35	2026-07-14 10:38:35
783	Zq7kqeSpbreO1p19ZxTFNpmmpH7GrvLlqT7tdG5d	52.167.144.139	2026-07-14	[{"path":"\\/login","time":"11:23"}]	2026-07-14 11:23:19	2026-07-14 11:23:19
767	yoIZvLZPkLZ1JwRyPDdAUNWicc6PxkPxgcSLHhMo	202.47.162.58	2026-07-14	[{"path":"\\/","time":"09:22"},{"path":"\\/catalog","time":"09:22"},{"path":"\\/client-area","time":"09:23"},{"path":"\\/client-area\\/plugin","time":"09:23"},{"path":"\\/saas-marketplace","time":"09:23"},{"path":"\\/saas\\/chatbot-plugin","time":"09:23"},{"path":"\\/checkout","time":"09:24"},{"path":"\\/order\\/instruction\\/33","time":"09:24"},{"path":"\\/client-area\\/invoices","time":"09:24"},{"path":"\\/client-area\\/plugin","time":"09:24"},{"path":"\\/catalog","time":"09:24"},{"path":"\\/client-area","time":"09:24"},{"path":"\\/catalog","time":"09:24"},{"path":"\\/saas-marketplace","time":"09:25"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"09:25"},{"path":"\\/cart","time":"09:25"},{"path":"\\/checkout","time":"09:25"},{"path":"\\/cart","time":"09:25"},{"path":"\\/catalog","time":"09:25"},{"path":"\\/","time":"09:25"},{"path":"\\/services","time":"09:26"},{"path":"\\/client-area","time":"09:26"},{"path":"\\/client-area\\/invoices","time":"09:26"},{"path":"\\/client-area\\/plugin","time":"09:26"},{"path":"\\/client-area\\/products","time":"09:26"},{"path":"\\/client-area\\/services\\/39\\/manage","time":"09:32"},{"path":"\\/client-area","time":"09:32"},{"path":"\\/","time":"09:33"},{"path":"\\/client-area","time":"09:33"},{"path":"\\/client-area\\/plugin\\/manage","time":"09:33"},{"path":"\\/client-area\\/plugin","time":"09:33"},{"path":"\\/client-area\\/invoices","time":"09:33"},{"path":"\\/client-area\\/plugin","time":"09:33"},{"path":"\\/client-area\\/plugin\\/manage","time":"09:34"},{"path":"\\/client-area\\/plugin","time":"10:42"}]	2026-07-14 09:22:04	2026-07-14 10:42:36
784	fNBkUu1SMRqOg6exXVP1noTVhMfXrMRTFsUU6pSC	52.86.237.71	2026-07-14	[{"path":"\\/client-area\\/plugin\\/manage","time":"11:25"}]	2026-07-14 11:25:42	2026-07-14 11:25:42
785	oXC2QqishZXv5iU1hWp7OgZDri7OebN7ooAB2fSd	54.167.205.40	2026-07-14	[{"path":"\\/client-area\\/plugin\\/manage","time":"11:58"}]	2026-07-14 11:58:58	2026-07-14 11:58:58
877	e1V5z0IRF2TmgRlRf9PKJDLi5pPNRmGJP7PibwZD	66.249.79.8	2026-07-27	[{"path":"\\/","time":"08:47"}]	2026-07-27 08:47:10	2026-07-27 08:47:10
892	t5t6qcJjSnTcf33cORTarS0QR5jwmA16yPYXfCfx	66.249.68.136	2026-07-30	[{"path":"\\/","time":"22:47"}]	2026-07-30 22:47:26	2026-07-30 22:47:26
907	gLi4ZRs2oNMUh3R0YUGhcAejIBX1scCcWkQsXWVV	103.147.8.19	2026-08-03	[{"path":"\\/login","time":"10:37"}]	2026-08-03 10:37:29	2026-08-03 10:37:29
1015	44HLEYqmbwJhoUVWUL6HrVNnwTZZwcYkCJpbWFay	103.18.34.207	2026-08-10	[{"path":"\\/admin\\/dashboard","time":"12:45"},{"path":"\\/admin\\/monitoring","time":"12:46"},{"path":"\\/admin\\/dashboard","time":"15:11"},{"path":"\\/admin\\/monitoring","time":"15:11"},{"path":"\\/admin\\/orders","time":"15:22"},{"path":"\\/admin\\/plugin-management","time":"15:22"},{"path":"\\/admin\\/plugin\\/4\\/edit","time":"15:22"},{"path":"\\/admin\\/plugin-management","time":"15:22"},{"path":"\\/admin\\/plugin\\/5\\/edit","time":"15:22"},{"path":"\\/admin\\/plugin-management","time":"15:23"}]	2026-08-10 12:45:59	2026-08-10 15:23:16
920	7oSHMhmSYZkgxuE4i0dWr7hxKlg3ojrMmLdgUaku	103.147.8.19	2026-08-03	[{"path":"\\/","time":"12:27"},{"path":"\\/client-area","time":"12:27"},{"path":"\\/client-area\\/plugin","time":"12:27"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:02"},{"path":"\\/client-area\\/plugin","time":"13:02"},{"path":"\\/catalog","time":"13:09"},{"path":"\\/saas-marketplace","time":"13:09"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"13:10"},{"path":"\\/cart","time":"13:10"},{"path":"\\/checkout","time":"13:10"},{"path":"\\/order\\/instruction\\/49","time":"13:10"},{"path":"\\/client-area","time":"13:10"},{"path":"\\/client-area\\/plugin","time":"13:10"}]	2026-08-03 12:27:48	2026-08-03 13:10:24
999	4XrykzBlGyjodwR4BcmQVdOuA6akqmd37bwf2zAa	103.18.34.205	2026-08-07	[{"path":"\\/","time":"13:12"},{"path":"\\/login","time":"13:12"}]	2026-08-07 13:12:01	2026-08-07 13:12:06
935	jdchtrincQGCLIYFTFaY0QT1I4UX0g69b5WSY5JF	103.147.8.19	2026-08-04	[{"path":"\\/","time":"09:55"},{"path":"\\/login","time":"09:55"}]	2026-08-04 09:55:17	2026-08-04 09:55:20
986	feUExZNY66MerwKZkSTAVOz3waCIPHKwGgoKid5J	182.253.150.2	2026-08-05	[{"path":"\\/","time":"17:01"}]	2026-08-05 17:01:33	2026-08-05 17:01:33
1031	LN704FEz0yo9DW508sfJNdvzc6T4N7gT2CQONwqs	103.28.52.219	2026-08-10	[{"path":"\\/","time":"19:07"},{"path":"\\/catalog","time":"19:08"}]	2026-08-10 19:07:16	2026-08-10 19:08:26
1047	Mi2BSI3d1fa6CLKnzmGaq60tzCxc70pBL2QbUdwN	182.8.255.93	2026-08-11	[{"path":"\\/","time":"21:29"}]	2026-08-11 21:29:17	2026-08-11 21:29:17
1062	fADGQHFwqV97DlfgGOVMdt1r1RckTG1CdGhFtpLT	125.160.231.220	2026-08-12	[{"path":"\\/","time":"16:13"}]	2026-08-12 16:13:55	2026-08-12 16:13:55
1076	AOd4fl2nA8lul3kziZNLU9yebpNp1EoItWxrtq6O	82.158.131.175	2026-08-12	[{"path":"\\/client-area\\/plugin\\/manage","time":"21:49"}]	2026-08-12 21:49:57	2026-08-12 21:49:57
1160	PKmXI2zSbjpqcrQ8bDJ3pzA4pKnFs5XA6SLKqeWa	66.249.66.76	2026-08-23	[{"path":"\\/login","time":"00:02"}]	2026-08-23 00:02:02	2026-08-23 00:02:02
1177	vRkK3rWrEhW8Imbw25Tswu1tZe5I8zys3tm7jIBZ	66.249.64.170	2026-08-25	[{"path":"\\/login","time":"01:05"}]	2026-08-25 01:05:09	2026-08-25 01:05:09
1195	nQ37QsvzGdhttaUGuoKgI9PN49jKl1oXpVPE7Uyd	114.10.120.90	2026-08-27	[{"path":"\\/","time":"17:18"}]	2026-08-27 17:18:43	2026-08-27 17:18:44
1211	xuahZlZ2uf4iAwdd1xJWyjSn7TMQZV1OMAl3A6wB	66.249.66.69	2026-08-29	[{"path":"\\/contact","time":"11:22"}]	2026-08-29 11:22:16	2026-08-29 11:22:16
786	xhMtTHJR7CiELuekHbtw2WfUUeMG2eMSCfAc1lP8	103.152.239.14	2026-07-14	[{"path":"\\/","time":"14:17"},{"path":"\\/login","time":"14:17"}]	2026-07-14 14:17:22	2026-07-14 14:17:29
787	oJM1OJTUXhps9Nh04Qz9kShWL0uHBoPNayr59HKb	103.152.239.14	2026-07-14	[{"path":"\\/login","time":"14:17"}]	2026-07-14 14:17:46	2026-07-14 14:17:46
770	ghOtPkdm5rWt9t0LD6nErJGtvgSOyvnOdzJp6aPO	103.147.8.19	2026-07-14	[{"path":"\\/","time":"10:12"},{"path":"\\/catalog","time":"10:13"},{"path":"\\/domain-registration","time":"10:13"},{"path":"\\/order\\/domain","time":"10:13"},{"path":"\\/cart","time":"10:14"},{"path":"\\/catalog","time":"10:15"},{"path":"\\/","time":"10:15"},{"path":"\\/client-area","time":"10:16"},{"path":"\\/client-area\\/plugin","time":"10:16"},{"path":"\\/saas-marketplace","time":"10:16"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"10:16"},{"path":"\\/cart","time":"10:16"},{"path":"\\/checkout","time":"10:16"},{"path":"\\/order\\/instruction\\/35","time":"10:16"},{"path":"\\/client-area\\/invoices","time":"10:17"},{"path":"\\/client-area\\/plugin","time":"10:17"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:17"},{"path":"\\/client-area\\/plugin","time":"10:17"},{"path":"\\/client-area\\/invoices","time":"10:18"},{"path":"\\/client-area\\/domain","time":"10:32"},{"path":"\\/client-area\\/plugin","time":"10:37"},{"path":"\\/client-area\\/plugin\\/manage","time":"10:37"},{"path":"\\/client-area\\/plugin","time":"10:37"},{"path":"\\/client-area\\/invoices","time":"10:37"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:16"},{"path":"\\/saas-marketplace","time":"11:16"},{"path":"\\/saas\\/chatbot-plugin","time":"11:16"},{"path":"\\/cart","time":"11:16"},{"path":"\\/checkout","time":"11:16"},{"path":"\\/order\\/instruction\\/36","time":"11:16"},{"path":"\\/client-area\\/invoices","time":"11:16"},{"path":"\\/client-area\\/plugin","time":"11:35"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:50"},{"path":"\\/client-area\\/plugin","time":"11:50"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:50"},{"path":"\\/client-area\\/plugin","time":"11:51"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:57"},{"path":"\\/client-area\\/plugin","time":"12:05"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:09"},{"path":"\\/client-area\\/plugin","time":"12:11"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:12"},{"path":"\\/client-area\\/plugin","time":"12:14"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:17"},{"path":"\\/client-area\\/plugin","time":"12:17"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:18"},{"path":"\\/client-area\\/plugin","time":"12:19"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:20"},{"path":"\\/client-area\\/plugin","time":"12:28"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:33"}]	2026-07-14 10:12:58	2026-07-14 12:33:22
789	B8OUXk3Jg0AdjlaDI1cAl3hYbXYUTE197VHmPeTS	103.18.34.205	2026-07-15	[{"path":"\\/client-area\\/plugin\\/manage","time":"00:00"},{"path":"\\/admin\\/plugin-customers","time":"00:02"}]	2026-07-15 00:00:43	2026-07-15 00:02:04
790	S4HJ9qK5h3XKfJoS5OZDKaoxvuSjEdRIn9aD16YI	52.167.144.181	2026-07-15	[{"path":"\\/about-us","time":"03:22"}]	2026-07-15 03:22:16	2026-07-15 03:22:16
791	zsJ6gQWeZGqAHzmAFrzqyG9ArUE1aui2c9XTQ1Ie	173.252.87.115	2026-07-15	[{"path":"\\/","time":"08:15"}]	2026-07-15 08:15:36	2026-07-15 08:15:36
792	8sgkTJpWxyoZiG4K604Z5CNFulp6nAVtyCou4Zla	173.252.87.9	2026-07-15	[{"path":"\\/","time":"08:15"}]	2026-07-15 08:15:36	2026-07-15 08:15:36
793	ttfJe8kfkPKoBZ0I4DiqzBGJDNhpFOQf3arHGGo1	173.252.87.5	2026-07-15	[{"path":"\\/","time":"08:15"}]	2026-07-15 08:15:42	2026-07-15 08:15:42
794	KJzZPb5iXTrXyqw4G8ILiBdYtyEpDK1jU4abKpR4	173.252.87.9	2026-07-15	[{"path":"\\/","time":"08:15"}]	2026-07-15 08:15:43	2026-07-15 08:15:43
802	DWSfEJ8YRE3Pm2VN3aaXEZrpVQiadsTSZ0arYDD4	54.145.94.227	2026-07-15	[{"path":"\\/services","time":"15:15"}]	2026-07-15 15:15:25	2026-07-15 15:15:25
795	Tikig8ThyQfi72IOzjItYdLfrLDsD4seW3gNlu5o	103.147.8.19	2026-07-15	[{"path":"\\/","time":"14:39"},{"path":"\\/login","time":"14:39"}]	2026-07-15 14:39:46	2026-07-15 14:39:47
796	I2irHyo7JwQOBnUEjTy1DaRgAtR463x88LWbZdvs	103.147.8.19	2026-07-15	[{"path":"\\/login","time":"14:39"}]	2026-07-15 14:39:53	2026-07-15 14:39:53
803	VeMCT1gVq5IAB1wiALqZxBm1wwe9LxkIxh89Kkfn	98.91.242.171	2026-07-15	[{"path":"\\/saas-marketplace","time":"15:16"}]	2026-07-15 15:16:57	2026-07-15 15:16:57
798	ql0ZOQAERMx6lucePm81805Vw3DgvJotYjODD2fJ	202.47.162.58	2026-07-15	[{"path":"\\/login","time":"14:40"}]	2026-07-15 14:40:39	2026-07-15 14:40:39
799	Si5EnH5pLK8NnUAZPfmNtMuomJm6D1Xe1mvEayFy	202.47.162.58	2026-07-15	[{"path":"\\/login","time":"14:40"}]	2026-07-15 14:40:51	2026-07-15 14:40:51
804	K4jL9UWP3v8WV7d6Mel49d1goJW7ySqISdpSADTe	54.91.30.118	2026-07-15	[{"path":"\\/saas\\/chatbot-plugin","time":"15:17"}]	2026-07-15 15:17:43	2026-07-15 15:17:43
801	qd1rF7Hw3FzaiyctcFxJxmhBxFxWWWw1VQ34HLgx	54.157.35.56	2026-07-15	[{"path":"\\/","time":"14:41"}]	2026-07-15 14:41:29	2026-07-15 14:41:29
805	TfR0Vtf3yOQbe3HJTIqcJ8JIQ3lj993d3h6aPi9z	98.83.139.114	2026-07-15	[{"path":"\\/order\\/instruction\\/40","time":"15:17"}]	2026-07-15 15:17:49	2026-07-15 15:17:49
809	GzY5ttjlsy7l8o4g2b30nHuYiOsbFukPkpnv5Umj	103.18.34.205	2026-07-15	[{"path":"\\/","time":"16:03"},{"path":"\\/client-area","time":"16:04"},{"path":"\\/client-area\\/saas","time":"16:04"},{"path":"\\/client-area\\/plugin","time":"16:04"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:57"},{"path":"\\/client-area\\/plugin","time":"17:12"}]	2026-07-15 16:03:59	2026-07-15 17:12:21
878	ERAPHh1c3mRF7aDY7PPRP4gcntd85kfJJatRrPeB	66.249.66.202	2026-07-27	[{"path":"\\/register","time":"09:10"}]	2026-07-27 09:10:55	2026-07-27 09:10:55
806	pv8jaE0bil0VWzx7hlwqkms1otIqf5DNby31IN0C	103.18.34.205	2026-07-15	[{"path":"\\/","time":"15:55"},{"path":"\\/login","time":"15:55"},{"path":"\\/","time":"15:55"}]	2026-07-15 15:55:28	2026-07-15 15:55:39
893	4viziBFGx86eV478ao2NtnWjGjS17Yrani3uP5EA	103.147.8.19	2026-07-30	[{"path":"\\/","time":"23:21"}]	2026-07-30 23:21:57	2026-07-30 23:21:57
807	LUDpWJv2mHhd2YYxsj56jcw7EMdngGkrZHbaQxDG	103.18.34.205	2026-07-15	[{"path":"\\/admin\\/dashboard","time":"15:56"},{"path":"\\/admin\\/orders","time":"15:56"},{"path":"\\/admin\\/orders\\/40","time":"15:56"},{"path":"\\/admin\\/orders","time":"16:01"},{"path":"\\/admin\\/orders\\/40","time":"16:01"},{"path":"\\/","time":"16:03"},{"path":"\\/login","time":"16:03"},{"path":"\\/admin\\/orders","time":"16:46"},{"path":"\\/admin\\/orders\\/34","time":"16:46"},{"path":"\\/admin\\/orders","time":"16:49"},{"path":"\\/admin\\/plugin-customers","time":"16:49"}]	2026-07-15 15:56:05	2026-07-15 16:49:16
921	m1MMg7C1ggPuBVgjzOaAQLbKSuRUzPdrVte22NFY	52.167.144.146	2026-08-03	[{"path":"\\/about-us","time":"15:02"}]	2026-08-03 15:02:41	2026-08-03 15:02:41
808	EDDzItkfK1APoDczp1PwkxY0cGWT94LORpTE5m0b	103.18.34.205	2026-07-15	[{"path":"\\/login","time":"16:03"}]	2026-07-15 16:03:52	2026-07-15 16:03:52
936	o5m1RDBIOREgJzgUjVyoc0Okz5eF3BINsHQgiiLU	103.147.8.19	2026-08-04	[{"path":"\\/login","time":"09:55"}]	2026-08-04 09:55:28	2026-08-04 09:55:28
908	Ir4wib2GKiUAvKxsoDSUiCgBCllH9a8YLnLUvhGT	103.147.8.19	2026-08-03	[{"path":"\\/","time":"10:37"},{"path":"\\/saas-marketplace","time":"10:37"},{"path":"\\/saas\\/chatbot-plugin","time":"10:37"},{"path":"\\/cart","time":"10:37"},{"path":"\\/catalog","time":"10:38"},{"path":"\\/saas-marketplace","time":"10:38"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"10:38"},{"path":"\\/cart","time":"10:38"},{"path":"\\/checkout","time":"10:38"},{"path":"\\/order\\/instruction\\/46","time":"10:38"},{"path":"\\/client-area\\/invoices","time":"10:39"},{"path":"\\/client-area\\/plugin","time":"10:39"}]	2026-08-03 10:37:43	2026-08-03 10:39:06
987	9e6oXtIr4pC2fMaARHeWsMkqCJhpON2Vj1WlQHIG	103.82.127.130	2026-08-06	[{"path":"\\/","time":"10:14"}]	2026-08-06 10:14:05	2026-08-06 10:14:05
1063	AplvyYWxQCRtr2yNNUtotDyATnAR8mYmwwL8qGzj	82.158.131.175	2026-08-12	[{"path":"\\/login","time":"17:01"}]	2026-08-12 17:01:23	2026-08-12 17:01:23
1032	kcDV3NrCEHZARJJODMvDigxiPegx2IvWvDHBjfZK	114.10.150.162	2026-08-10	[{"path":"\\/","time":"19:43"},{"path":"\\/services","time":"19:43"}]	2026-08-10 19:43:16	2026-08-10 19:43:27
1000	aD0QLFK99diiLTuQFe717Gn39PXoojR9BI4nuL5H	103.18.34.205	2026-08-07	[{"path":"\\/","time":"13:12"},{"path":"\\/client-area","time":"13:12"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:12"}]	2026-08-07 13:12:29	2026-08-07 13:12:36
1016	ZeQbWe0VUi09nCYjxwHyB2Ft0TZJOgoU3Bw8rDOD	17.246.23.17	2026-08-10	[{"path":"\\/cpanel-hosting","time":"14:50"}]	2026-08-10 14:50:40	2026-08-10 14:50:40
1048	d76OR1E7fY9r7jTG9mauCQ1RUd0cMf4cwogjWrhb	140.213.6.225	2026-08-11	[{"path":"\\/","time":"22:02"}]	2026-08-11 22:02:52	2026-08-11 22:02:52
1077	A9i3iavtxZJoSQMcjwU3EgCBco1phNo8uxPGVsgV	82.158.131.175	2026-08-12	[{"path":"\\/login","time":"21:50"}]	2026-08-12 21:50:12	2026-08-12 21:50:12
1085	fi1KqrBSGluCzWEQd9ZJR0sFWWwbgVrxZke5FOOX	82.158.131.175	2026-08-13	[{"path":"\\/","time":"16:55"},{"path":"\\/saas-marketplace","time":"16:55"},{"path":"\\/","time":"17:16"}]	2026-08-13 16:55:28	2026-08-13 17:16:44
1161	mDlIRR1NovFXF7HnvykRmIzDc3OmC7uliTv4hlxh	66.249.68.130	2026-08-23	[{"path":"\\/saas\\/monitoring-visitor-plugin","time":"00:05"}]	2026-08-23 00:05:22	2026-08-23 00:05:22
1178	0UQCLz4UGnpXJayYANS0jHZgDlnOFM9rtXG50cS7	66.249.71.97	2026-08-25	[{"path":"\\/login","time":"04:49"}]	2026-08-25 04:49:35	2026-08-25 04:49:35
1196	adYcWGZaS1otrCpbonl6Ky9a84wtK0JmIJHxmzlP	114.10.120.90	2026-08-27	[{"path":"\\/domain-registration","time":"18:00"}]	2026-08-27 18:00:06	2026-08-27 18:00:06
879	q959rftei7ajCd21Qc6iwnAWB1WOPPwH8tn3ocQS	167.235.93.252	2026-07-27	[{"path":"\\/","time":"14:04"}]	2026-07-27 14:04:38	2026-07-27 14:04:38
894	N8EIUpZmZNq5LdAA5e9GsjztePLgIYYq03E9Fe13	114.10.16.140	2026-07-31	[{"path":"\\/","time":"05:36"}]	2026-07-31 05:36:38	2026-07-31 05:36:38
1017	by3NkpqmoliiXxzidbQ9IhtmCynxPcO3QOpJjnb5	103.18.34.207	2026-08-10	[{"path":"\\/login","time":"15:09"}]	2026-08-10 15:09:28	2026-08-10 15:09:28
1033	CUkxnojzW1Z2cBzYfpUxFTbHey2qc7qkLa26cd8I	182.6.0.8	2026-08-10	[{"path":"\\/","time":"19:52"}]	2026-08-10 19:52:37	2026-08-10 19:52:37
1049	i3g9FyyTVxHqRkZkUx5jBcwfHZf0FL4YPnxExE2L	160.202.36.99	2026-08-12	[{"path":"\\/","time":"02:45"}]	2026-08-12 02:45:46	2026-08-12 02:45:46
1064	SJ0t67Zz1CytmX0uxtnEJOhXFEt1KGOvgIqEvVAo	82.158.131.175	2026-08-12	[{"path":"\\/client-area\\/plugin\\/manage","time":"17:01"}]	2026-08-12 17:01:31	2026-08-12 17:01:31
1078	x0R4YaUdrfuVr6vlKoXVaedBl1lkvcpBk3e3Dk8e	82.158.131.175	2026-08-12	[{"path":"\\/","time":"21:50"},{"path":"\\/client-area\\/plugin\\/manage","time":"21:51"}]	2026-08-12 21:50:32	2026-08-12 21:51:14
1086	eAWrBJzgIL8HGniYc1aiFWy1MfJSrXwVJuxRukkv	106.215.162.177	2026-08-13	[{"path":"\\/","time":"16:56"}]	2026-08-13 16:56:48	2026-08-13 16:56:48
909	WFb0T5nKavsN2CgfkRC7VEHTElvooLt1dhFiA1H9	103.147.8.19	2026-08-03	[{"path":"\\/admin\\/dashboard","time":"10:38"},{"path":"\\/admin\\/orders","time":"10:38"},{"path":"\\/admin\\/orders\\/46","time":"10:38"},{"path":"\\/admin\\/users","time":"11:34"},{"path":"\\/admin\\/orders","time":"11:37"},{"path":"\\/admin\\/orders\\/47","time":"11:37"},{"path":"\\/admin\\/orders","time":"11:38"},{"path":"\\/admin\\/orders\\/48","time":"11:38"},{"path":"\\/admin\\/products","time":"13:09"},{"path":"\\/admin\\/plugin-management","time":"13:09"},{"path":"\\/admin\\/plugin-customers","time":"13:09"},{"path":"\\/admin\\/orders","time":"13:10"},{"path":"\\/admin\\/orders\\/49","time":"13:10"}]	2026-08-03 10:38:41	2026-08-03 13:10:13
922	P1FMujbAy3B3raau2UkHmd7ZcqZjkKOi0edEIUeT	103.147.8.19	2026-08-03	[{"path":"\\/login","time":"16:28"}]	2026-08-03 16:28:03	2026-08-03 16:28:03
1162	jdoDvbkLmS15SFAzFDSEReOWPnxEuYZuZ98aS0TI	66.249.66.203	2026-08-23	[{"path":"\\/order\\/cpanel","time":"11:10"}]	2026-08-23 11:10:04	2026-08-23 11:10:04
937	NYAF7rWlpEYI2ZhyVi39u9x1Nesh4r56YIXeXQBz	103.147.8.19	2026-08-04	[{"path":"\\/","time":"09:55"},{"path":"\\/profile","time":"09:55"}]	2026-08-04 09:55:36	2026-08-04 09:55:39
988	qyhHFXfqGJytTrJYOcv9QnBWSAgb5utGjp8X8DLM	182.8.255.157	2026-08-06	[{"path":"\\/login","time":"10:24"}]	2026-08-06 10:24:04	2026-08-06 10:24:05
1001	2qQff6eGVLXoqYbrKmMPhNNuTFoCX4rKhs990vAR	34.46.138.166	2026-08-07	[{"path":"\\/vps-hosting","time":"13:36"}]	2026-08-07 13:36:37	2026-08-07 13:36:37
1179	0MPGbaJaCxnpNosReO1ZW9UjqL38Pm9ss9Rx3w1a	66.249.68.129	2026-08-25	[{"path":"\\/","time":"05:29"}]	2026-08-25 05:29:10	2026-08-25 05:29:10
1197	eE2D1m0gqal1ZUxTyw9WymGIhYEv8W0TWogIHFmN	66.249.66.96	2026-08-28	[{"path":"\\/domain-registration","time":"01:36"}]	2026-08-28 01:36:47	2026-08-28 01:36:48
1212	UJ4IJrVcpewXjmmnmLKEfO6Vi3P8WsYch5LjSq8l	66.249.71.171	2026-08-29	[{"path":"\\/portfolio","time":"13:10"}]	2026-08-29 13:10:20	2026-08-29 13:10:20
1226	rAk2KXkP5HjAEM8MnKfMDnESmlU5Oo86swh25llP	103.147.8.141	2026-08-31	[{"path":"\\/client-area","time":"19:40"},{"path":"\\/client-area\\/plugin\\/manage","time":"19:40"}]	2026-08-31 19:40:23	2026-08-31 19:40:27
1240	Zr1mxAmTk3eGs8CxHROO1VvkJestCdhfRSomSaEN	103.147.8.141	2026-09-01	[{"path":"\\/","time":"08:47"},{"path":"\\/login","time":"08:47"}]	2026-09-01 08:47:18	2026-09-01 08:47:18
1254	9X7qo0MjGCb6UvHwmgRwXMv2a0KvBdfzqool3v3Q	173.252.87.41	2026-09-02	[{"path":"\\/","time":"10:43"}]	2026-09-02 10:43:10	2026-09-02 10:43:10
1281	AS4oTtErC6hKsUgbCruQvML1oSdJRsoQ4dlbhUcE	66.249.71.170	2026-09-06	[{"path":"\\/login","time":"03:52"}]	2026-09-06 03:52:43	2026-09-06 03:52:43
797	g1Oz6DWBYRocAU7lMuvMTf3Fn0zRcJ9h2mh9TJxL	103.147.8.19	2026-07-15	[{"path":"\\/","time":"14:40"},{"path":"\\/client-area","time":"14:40"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:40"},{"path":"\\/client-area\\/plugin","time":"14:44"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:48"},{"path":"\\/client-area\\/plugin","time":"14:49"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:13"},{"path":"\\/catalog","time":"15:13"},{"path":"\\/services","time":"15:13"},{"path":"\\/catalog","time":"15:13"},{"path":"\\/saas-marketplace","time":"15:13"},{"path":"\\/saas\\/chatbot-plugin","time":"15:13"},{"path":"\\/cart","time":"15:13"},{"path":"\\/checkout","time":"15:13"},{"path":"\\/catalog","time":"15:13"},{"path":"\\/saas-marketplace","time":"15:14"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"15:14"},{"path":"\\/cart","time":"15:14"},{"path":"\\/checkout","time":"15:14"},{"path":"\\/order\\/instruction\\/40","time":"15:14"},{"path":"\\/client-area\\/invoices","time":"15:14"},{"path":"\\/client-area\\/plugin","time":"16:02"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:02"},{"path":"\\/client-area\\/plugin","time":"16:02"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:04"},{"path":"\\/client-area\\/plugin","time":"16:09"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:21"},{"path":"\\/client-area\\/plugin","time":"16:21"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:22"},{"path":"\\/client-area\\/plugin","time":"16:23"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:49"},{"path":"\\/client-area\\/plugin","time":"16:49"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:50"},{"path":"\\/client-area\\/plugin","time":"17:01"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:07"},{"path":"\\/client-area\\/plugin","time":"17:15"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:15"},{"path":"\\/client-area\\/plugin","time":"17:15"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:16"},{"path":"\\/client-area\\/plugin","time":"17:27"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:30"},{"path":"\\/client-area\\/plugin","time":"17:34"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:55"},{"path":"\\/client-area\\/plugin","time":"18:19"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:31"}]	2026-07-15 14:40:05	2026-07-15 18:31:04
810	DqvvHaLAz4MpLWZVUf72WeC0S1QIdZV9Z9lp68eR	103.152.239.14	2026-07-15	[{"path":"\\/login","time":"17:31"}]	2026-07-15 17:31:55	2026-07-15 17:31:55
811	5lBQ7V9H9CxSID48rERRIuaRa46dW9y4wQrCec9A	103.152.239.14	2026-07-15	[{"path":"\\/login","time":"17:32"}]	2026-07-15 17:32:08	2026-07-15 17:32:08
812	hMN8rCUgHpHPd3qSRJ2lYvSzyiKDuibJQs6vGjn1	103.152.239.14	2026-07-15	[{"path":"\\/","time":"17:32"},{"path":"\\/catalog","time":"17:32"},{"path":"\\/services","time":"17:32"},{"path":"\\/","time":"17:32"},{"path":"\\/contact","time":"17:32"},{"path":"\\/catalog","time":"17:33"},{"path":"\\/saas-marketplace","time":"17:33"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"17:33"},{"path":"\\/cart","time":"17:33"},{"path":"\\/checkout","time":"17:33"},{"path":"\\/order\\/instruction\\/41","time":"17:33"},{"path":"\\/client-area\\/invoices","time":"17:34"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:34"},{"path":"\\/client-area\\/plugin","time":"17:34"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:34"},{"path":"\\/client-area\\/saas","time":"17:34"},{"path":"\\/client-area\\/plugin","time":"17:38"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:38"},{"path":"\\/client-area\\/plugin","time":"17:38"},{"path":"\\/client-area\\/saas","time":"17:38"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:38"},{"path":"\\/client-area\\/plugin","time":"17:38"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:56"},{"path":"\\/client-area\\/plugin","time":"17:57"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:58"},{"path":"\\/client-area\\/plugin","time":"17:58"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:00"},{"path":"\\/client-area\\/plugin","time":"18:12"},{"path":"\\/client-area\\/saas","time":"18:12"},{"path":"\\/client-area\\/services\\/47\\/manage","time":"18:24"},{"path":"\\/client-area\\/plugin","time":"18:29"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:34"},{"path":"\\/client-area\\/plugin","time":"18:36"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:36"}]	2026-07-15 17:32:14	2026-07-15 18:36:47
880	kZ5KZD7nGQgtg9ivT4UeNXB82sfR2evNiPndoltx	40.77.167.136	2026-07-27	[{"path":"\\/about-us","time":"14:19"}]	2026-07-27 14:19:52	2026-07-27 14:19:52
895	wAXbbk9Pny3TVaZ24danqxgSf3ze2L6StbXNbFqd	17.22.245.72	2026-07-31	[{"path":"\\/domain-registration","time":"07:32"}]	2026-07-31 07:32:59	2026-07-31 07:32:59
1034	dxL9PFuHFnT60Y4O4y8m3lpxesgD9wkQbvphbch4	112.215.45.135	2026-08-10	[{"path":"\\/","time":"21:15"}]	2026-08-10 21:15:51	2026-08-10 21:15:51
910	4OTls14XKxCo2GdnrcVHR9zQMJS0AeaU82SIJ7hp	203.83.42.251	2026-08-03	[{"path":"\\/","time":"11:25"},{"path":"\\/login","time":"11:25"},{"path":"\\/","time":"11:33"}]	2026-08-03 11:25:12	2026-08-03 11:33:13
1050	ps5wYvZnSXmP2qIRRfS1DCM06EQ4I8WGJoeKWIut	66.249.66.203	2026-08-12	[{"path":"\\/register","time":"02:47"}]	2026-08-12 02:47:43	2026-08-12 02:47:43
1018	D9ESI7EiREZCVb1KRhanINhFO9EMgqCQHVafqVPP	103.18.34.207	2026-08-10	[{"path":"\\/client-area\\/plugin\\/manage","time":"15:09"},{"path":"\\/","time":"15:11"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:16"},{"path":"\\/client-area","time":"15:20"},{"path":"\\/","time":"15:20"},{"path":"\\/saas-marketplace","time":"15:20"},{"path":"\\/saas\\/chatbot-plugin","time":"15:20"},{"path":"\\/saas-marketplace","time":"15:23"},{"path":"\\/client-area","time":"15:24"},{"path":"\\/client-area\\/plugin","time":"15:28"},{"path":"\\/client-area","time":"15:28"},{"path":"\\/","time":"15:28"},{"path":"\\/services","time":"15:28"},{"path":"\\/catalog","time":"15:28"},{"path":"\\/saas-marketplace","time":"15:28"},{"path":"\\/saas\\/chatbot-plugin","time":"15:28"},{"path":"\\/saas-marketplace","time":"15:28"}]	2026-08-10 15:09:50	2026-08-10 15:28:50
923	gBDnrPZk2x6TpK7A1cnMibeqOSLHMip0B3ucQX58	103.147.8.19	2026-08-03	[{"path":"\\/client-area\\/plugin\\/manage","time":"16:28"},{"path":"\\/client-area\\/plugin","time":"16:49"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:54"}]	2026-08-03 16:28:26	2026-08-03 16:54:19
938	lvEfq2sm3YRT3VqQ5IROZOFHAxXlaUznr0B1R9e5	182.8.255.1	2026-08-04	[{"path":"\\/","time":"10:19"},{"path":"\\/login","time":"10:31"}]	2026-08-04 10:19:52	2026-08-04 10:31:43
989	udt64iLQpcmWg7TYrFJgwKfIXPhQWPjzbqhY5TxM	182.8.255.157	2026-08-06	[{"path":"\\/client-area\\/plugin\\/manage","time":"10:24"}]	2026-08-06 10:24:09	2026-08-06 10:24:09
1002	dgfXDan3Y4LHa1F7GIrkpEU5lDfloiATXB5o3ikp	66.249.68.128	2026-08-07	[{"path":"\\/","time":"22:22"}]	2026-08-07 22:22:56	2026-08-07 22:22:56
1087	loadeV0SMDFcPuB9pJn5LEtQCcWcIQFcR1khBnfP	82.158.131.175	2026-08-13	[{"path":"\\/admin\\/dashboard","time":"17:14"},{"path":"\\/admin\\/saas-management","time":"17:14"},{"path":"\\/admin\\/saas\\/create","time":"17:14"},{"path":"\\/","time":"17:14"},{"path":"\\/catalog","time":"17:14"},{"path":"\\/saas-marketplace","time":"17:14"}]	2026-08-13 17:14:16	2026-08-13 17:14:55
1065	LqbRBNRCAFVGXpub9BJ6xBVStLBGLU1tjhDfti4C	82.158.131.175	2026-08-12	[{"path":"\\/","time":"17:01"},{"path":"\\/login","time":"17:01"}]	2026-08-12 17:01:40	2026-08-12 17:01:41
1079	TgXolbjtAVJmoGMr6fmsMOdq4H698ignLDUwJbPw	82.158.131.175	2026-08-13	[{"path":"\\/","time":"12:09"},{"path":"\\/login","time":"12:09"}]	2026-08-13 12:09:29	2026-08-13 12:09:32
1163	HET1TpIhzDXhgq7lMwNyGG4oqJCNULGBlTgeY45d	201.3.125.50	2026-08-23	[{"path":"\\/","time":"14:39"}]	2026-08-23 14:39:20	2026-08-23 14:39:20
1180	jcYOVSd11BRsCztcSuywLCl8SHp6l27AMxIIH3AL	66.249.68.129	2026-08-25	[{"path":"\\/","time":"05:29"}]	2026-08-25 05:29:14	2026-08-25 05:29:14
1198	wI6yAWYirjmhBWYv7xln2sKmuljrIjgCmPjiYeUV	207.46.13.102	2026-08-28	[{"path":"\\/","time":"02:14"}]	2026-08-28 02:14:59	2026-08-28 02:14:59
1213	aOegaXyDKhKIyjwQjHTwrmh8Go5mfd9ojFg5U5hR	66.249.64.170	2026-08-29	[{"path":"\\/cpanel-hosting","time":"13:29"}]	2026-08-29 13:29:22	2026-08-29 13:29:22
1227	IiNKHJrxsFTmbfuLdhtvmxE6f5x0SumGX5CHThW5	103.147.8.141	2026-08-31	[{"path":"\\/login","time":"20:38"}]	2026-08-31 20:38:26	2026-08-31 20:38:26
1268	fIcvL9M7ckS8pCsibx27RdnjGemVUQh4qZOLoQDU	66.249.66.199	2026-09-03	[{"path":"\\/","time":"22:48"}]	2026-09-03 22:48:15	2026-09-03 22:48:15
1241	VqATx4glUrgLHplNwyIsoCIitDlP0fFprJpkx0ZM	103.147.8.141	2026-09-01	[{"path":"\\/","time":"08:47"},{"path":"\\/client-area","time":"08:47"},{"path":"\\/client-area\\/plugin\\/manage","time":"08:47"}]	2026-09-01 08:47:23	2026-09-01 08:47:33
1255	ZwaR6GgZqjxQghlfRR6lTtqfpY4sSA2Qwnt9ayO4	103.188.50.120	2026-09-02	[{"path":"\\/about-us","time":"13:20"}]	2026-09-02 13:20:11	2026-09-02 13:20:11
1282	M52eVL3Va0poUa6WQDApdR968vX2eoWFtxHL9Urk	40.77.167.235	2026-09-06	[{"path":"\\/","time":"05:12"}]	2026-09-06 05:12:08	2026-09-06 05:12:08
800	yWiozdxAtGxkBukm3XJ7vHFB4io0V9kizv6EyKbM	202.47.162.58	2026-07-15	[{"path":"\\/client-area","time":"14:41"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:48"},{"path":"\\/client-area\\/plugin","time":"14:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:28"},{"path":"\\/client-area\\/products","time":"16:28"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:28"},{"path":"\\/client-area\\/plugin","time":"16:29"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:45"},{"path":"\\/client-area\\/plugin","time":"16:46"},{"path":"\\/client-area\\/products","time":"16:46"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:47"},{"path":"\\/client-area\\/plugin","time":"16:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:51"},{"path":"\\/client-area\\/plugin","time":"16:52"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:53"},{"path":"\\/client-area\\/plugin","time":"16:53"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:05"},{"path":"\\/client-area\\/plugin","time":"17:14"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:37"},{"path":"\\/client-area\\/plugin","time":"17:45"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:46"},{"path":"\\/client-area\\/plugin","time":"17:46"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:48"},{"path":"\\/catalog","time":"18:00"},{"path":"\\/client-area","time":"18:00"},{"path":"\\/client-area\\/plugin","time":"18:00"},{"path":"\\/catalog","time":"18:00"},{"path":"\\/client-area\\/plugin","time":"18:00"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:00"},{"path":"\\/cart","time":"18:01"},{"path":"\\/","time":"18:01"},{"path":"\\/client-area","time":"18:01"},{"path":"\\/client-area\\/invoices","time":"18:01"},{"path":"\\/client-area\\/plugin","time":"18:01"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:02"},{"path":"\\/client-area","time":"18:02"},{"path":"\\/","time":"18:02"},{"path":"\\/services","time":"18:02"},{"path":"\\/catalog","time":"18:02"},{"path":"\\/","time":"18:03"},{"path":"\\/catalog","time":"18:04"},{"path":"\\/client-area","time":"18:04"},{"path":"\\/client-area\\/products","time":"18:05"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:05"},{"path":"\\/catalog","time":"18:05"},{"path":"\\/saas-marketplace","time":"18:05"},{"path":"\\/saas\\/chatbot-plugin","time":"18:06"},{"path":"\\/cart","time":"18:06"},{"path":"\\/checkout","time":"18:06"},{"path":"\\/order\\/instruction\\/42","time":"18:06"},{"path":"\\/services","time":"18:06"},{"path":"\\/catalog","time":"18:06"},{"path":"\\/saas-marketplace","time":"18:06"},{"path":"\\/saas\\/chatbot-plugin","time":"18:06"},{"path":"\\/cart","time":"18:06"},{"path":"\\/catalog","time":"18:07"},{"path":"\\/saas-marketplace","time":"18:07"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"18:07"},{"path":"\\/cart","time":"18:07"},{"path":"\\/checkout","time":"18:07"},{"path":"\\/order\\/instruction\\/43","time":"18:07"},{"path":"\\/client-area","time":"18:07"},{"path":"\\/client-area\\/plugin","time":"18:07"},{"path":"\\/client-area\\/products","time":"18:07"},{"path":"\\/client-area\\/services\\/48\\/manage","time":"18:07"},{"path":"\\/client-area","time":"18:07"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:07"},{"path":"\\/","time":"18:39"},{"path":"\\/client-area","time":"18:39"},{"path":"\\/client-area\\/plugin","time":"18:39"}]	2026-07-15 14:41:15	2026-07-15 18:39:58
881	oasG5gA99aIQg57Kcuq7Qk158Qgo7eXxJO9jucFf	66.249.79.7	2026-07-27	[{"path":"\\/domain-registration","time":"20:16"}]	2026-07-27 20:16:46	2026-07-27 20:16:46
814	vApkPSOPMWXIPM6nGbZ3Vgti8TuZlB7d8cmihshW	103.152.239.14	2026-07-15	[{"path":"\\/","time":"18:36"},{"path":"\\/login","time":"18:36"}]	2026-07-15 18:36:51	2026-07-15 18:36:52
822	qNjwtEfet9VvpV2wUQa3ORjHlvf3J0Xa5R1pmKdN	103.152.239.14	2026-07-15	[{"path":"\\/","time":"18:56"},{"path":"\\/client-area","time":"18:56"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:56"},{"path":"\\/client-area\\/plugin","time":"18:57"}]	2026-07-15 18:56:35	2026-07-15 18:57:17
815	V1SFYXkb2a9luGLcCDEggS3MVeuLCgN7GCVmyKVz	103.152.239.14	2026-07-15	[{"path":"\\/","time":"18:36"},{"path":"\\/profile","time":"18:37"},{"path":"\\/","time":"18:37"},{"path":"\\/catalog","time":"18:37"},{"path":"\\/services","time":"18:37"},{"path":"\\/","time":"18:37"},{"path":"\\/client-area","time":"18:37"},{"path":"\\/client-area\\/plugin","time":"18:37"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:37"},{"path":"\\/client-area\\/plugin","time":"18:38"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:38"},{"path":"\\/client-area\\/plugin","time":"18:38"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:40"},{"path":"\\/client-area\\/plugin","time":"18:42"},{"path":"\\/client-area\\/plugin\\/manage","time":"18:43"}]	2026-07-15 18:36:57	2026-07-15 18:43:33
813	JBlkkYjAufP6mEZzNWHGf99OZBhNh6WS9YTqCF9l	114.10.79.247	2026-07-15	[{"path":"\\/admin\\/dashboard","time":"18:30"},{"path":"\\/admin\\/orders","time":"18:30"},{"path":"\\/admin\\/orders\\/41","time":"18:30"},{"path":"\\/admin\\/orders","time":"18:30"},{"path":"\\/admin\\/orders\\/42","time":"18:31"},{"path":"\\/admin\\/orders","time":"18:31"},{"path":"\\/admin\\/orders\\/43","time":"18:31"}]	2026-07-15 18:30:42	2026-07-15 18:31:09
823	zoWow3f0xh5KHxNy9ZpciU799LMmp4nkHjQXdjeg	202.47.162.58	2026-07-15	[{"path":"\\/login","time":"20:47"}]	2026-07-15 20:47:15	2026-07-15 20:47:15
818	OMOUajOnfNGMURZY0WLalwJycUszM5kLAtQjKKWo	154.17.110.89	2026-07-15	[{"path":"\\/","time":"18:54"}]	2026-07-15 18:54:12	2026-07-15 18:54:12
819	EF9NgNUtlMXlle3JnwssQHtVdYCoiHR4NTZ61Orx	103.151.92.49	2026-07-15	[{"path":"\\/about-us","time":"18:54"}]	2026-07-15 18:54:15	2026-07-15 18:54:15
817	Cp7JvOmtkrBJfr8r679rBiMykiTIfQY2KTGP557m	103.152.239.14	2026-07-15	[{"path":"\\/","time":"18:52"},{"path":"\\/login","time":"18:52"},{"path":"\\/","time":"18:53"},{"path":"\\/login","time":"18:54"}]	2026-07-15 18:52:09	2026-07-15 18:54:21
816	jPO6E5gdjACm94sVIHq9lCPfqIQqifEZXAWrr0q3	202.47.162.58	2026-07-15	[{"path":"\\/","time":"18:38"},{"path":"\\/login","time":"18:39"}]	2026-07-15 18:38:24	2026-07-15 18:39:40
827	Cixv81uyqExEDkQN91MlcEyS8BX82dvnnbhNsyx9	103.152.239.14	2026-07-15	[{"path":"\\/login","time":"21:51"}]	2026-07-15 21:51:23	2026-07-15 21:51:23
821	ml4dtIgRRgIqpIEVgMiIThCIsb4jha7mtMcpyiQx	103.152.239.14	2026-07-15	[{"path":"\\/login","time":"18:56"}]	2026-07-15 18:56:11	2026-07-15 18:56:11
820	LISJru52Hc3whFf8OqKqog1yn08NHNTItNb4BPd0	103.152.239.14	2026-07-15	[{"path":"\\/","time":"18:55"},{"path":"\\/login","time":"18:56"}]	2026-07-15 18:55:48	2026-07-15 18:56:31
829	EdbCNMErAPk0PHv4E7voi8sIb08BNxrvNLTMnkyK	103.18.34.205	2026-07-15	[{"path":"\\/login","time":"22:32"}]	2026-07-15 22:32:41	2026-07-15 22:32:41
825	ozzAzIjkhLRzUnxc6QOatEsiD4eAnZCrYpvWOKuN	103.152.239.14	2026-07-15	[{"path":"\\/login","time":"21:40"}]	2026-07-15 21:40:15	2026-07-15 21:40:15
828	9e0zTr37jkENoYa80SwmHvFzNQTXu685mNB1fJy7	103.18.34.205	2026-07-15	[{"path":"\\/admin\\/dashboard","time":"21:53"},{"path":"\\/","time":"21:53"},{"path":"\\/admin\\/plugin-customers","time":"21:53"},{"path":"\\/admin\\/orders","time":"22:29"},{"path":"\\/admin\\/orders\\/44","time":"22:29"},{"path":"\\/admin\\/orders","time":"22:29"},{"path":"\\/login","time":"22:32"},{"path":"\\/admin\\/plugin-customers","time":"22:39"},{"path":"\\/admin\\/orders","time":"22:54"},{"path":"\\/admin\\/orders\\/45","time":"22:54"},{"path":"\\/admin\\/dashboard","time":"22:56"},{"path":"\\/admin\\/orders","time":"22:56"}]	2026-07-15 21:53:23	2026-07-15 22:56:13
866	n1jcS1afjEyZu8hqjPzCvsp9QWeF0dfzqbJ9QVq5	66.249.79.36	2026-07-23	[{"path":"\\/login","time":"13:30"}]	2026-07-23 13:30:51	2026-07-23 13:30:51
830	UnZKItmhj4n4xxn8RVcHgLS4zkHg5VWI5LEJSVQA	103.18.34.205	2026-07-15	[{"path":"\\/","time":"22:32"},{"path":"\\/client-area","time":"22:32"},{"path":"\\/client-area\\/plugin","time":"22:33"}]	2026-07-15 22:32:55	2026-07-15 22:33:02
896	K0c7wSa248Sx38dYbfZWrjTBuyBrLXQFZOkTJ19V	71.6.235.140	2026-07-31	[{"path":"\\/","time":"15:29"}]	2026-07-31 15:29:22	2026-07-31 15:29:22
826	IWJONPNObBjC0he4xK9iOhLEF3SbxBcs9XyEvo0H	103.152.239.14	2026-07-15	[{"path":"\\/client-area\\/plugin\\/manage","time":"21:40"},{"path":"\\/client-area\\/saas","time":"22:03"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:03"},{"path":"\\/client-area\\/plugin","time":"22:03"},{"path":"\\/client-area\\/saas","time":"22:53"},{"path":"\\/client-area","time":"22:53"}]	2026-07-15 21:40:26	2026-07-15 22:53:14
911	dBFcHSIK27GwEegHA09Wien3tfFB70N7iwHmCX08	203.83.42.251	2026-08-03	[{"path":"\\/login","time":"11:25"}]	2026-08-03 11:25:25	2026-08-03 11:25:25
924	JO9sAM28gEKapU1xTLK5Pxi0Gv97FKnUShBUrqrf	103.147.8.19	2026-08-03	[{"path":"\\/","time":"17:47"},{"path":"\\/login","time":"17:47"}]	2026-08-03 17:47:36	2026-08-03 17:47:37
1019	1e3hsrrSwXnMoOelOGGBbWUsFPUothUJSGtdt3Sm	103.18.34.207	2026-08-10	[{"path":"\\/","time":"15:31"},{"path":"\\/catalog","time":"15:31"},{"path":"\\/saas-marketplace","time":"15:31"},{"path":"\\/login","time":"15:51"}]	2026-08-10 15:31:44	2026-08-10 15:51:22
990	gW4iPe02PNsIMTBmj0rpkmbD2YRYG8PpfpecIVm7	103.18.34.205	2026-08-06	[{"path":"\\/","time":"11:13"},{"path":"\\/login","time":"11:13"}]	2026-08-06 11:13:05	2026-08-06 11:13:09
1003	QNodiaLJLj7Ofv9RIqowEnkBTqfzhjSQ7sKWKMrM	66.249.66.204	2026-08-08	[{"path":"\\/register","time":"07:49"}]	2026-08-08 07:49:34	2026-08-08 07:49:34
1051	dLAl7VsVuebaqSU8oI3cbKQI18fcrQ7auMIBGirF	182.253.194.21	2026-08-12	[{"path":"\\/","time":"05:52"}]	2026-08-12 05:52:51	2026-08-12 05:52:51
1035	7R8EKIaCFdDvzUoyRxOH6uIMmTrKx0cBHcKszgyo	209.203.23.28	2026-08-11	[{"path":"\\/","time":"02:46"}]	2026-08-11 02:46:09	2026-08-11 02:46:09
1066	8i9lQ4xVcPeP4v4bXguGvuMO0iFvhvJ8cSvunlaA	82.158.131.175	2026-08-12	[{"path":"\\/","time":"17:01"},{"path":"\\/client-area","time":"17:01"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:01"}]	2026-08-12 17:01:53	2026-08-12 17:01:58
1080	VZZO6dYiaFfykoOxfE4OjjupQ1gk7EwtUC6qwYm5	82.158.131.175	2026-08-13	[{"path":"\\/","time":"12:10"},{"path":"\\/client-area","time":"12:11"},{"path":"\\/client-area\\/plugin\\/manage","time":"12:12"}]	2026-08-13 12:10:08	2026-08-13 12:12:07
1088	ZXXF2jPVLLk22yC9L9dOV1jxJvR8eTVMniyrOpFA	104.28.86.49	2026-08-13	[{"path":"\\/login","time":"17:19"}]	2026-08-13 17:19:03	2026-08-13 17:19:03
1164	rpQPyeMS0gQD3rG5hY6v0FrUEO0CXKTSVBVDJvsW	173.252.87.54	2026-08-23	[{"path":"\\/","time":"18:26"}]	2026-08-23 18:26:27	2026-08-23 18:26:27
1181	2qQENYXk4fYQY4G8DdOD0pyIiYaVZWjOchN6VnN1	66.249.71.96	2026-08-25	[{"path":"\\/register","time":"09:27"}]	2026-08-25 09:27:26	2026-08-25 09:27:27
824	m7GoqF2GTLWRAzGxQOZYsQ8plI1OS7PU5ubJzVxJ	202.47.162.58	2026-07-15	[{"path":"\\/client-area\\/plugin\\/manage","time":"20:47"},{"path":"\\/client-area\\/plugin","time":"20:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"21:30"},{"path":"\\/client-area\\/plugin","time":"21:31"},{"path":"\\/client-area\\/plugin\\/manage","time":"21:31"},{"path":"\\/client-area\\/plugin","time":"21:33"},{"path":"\\/client-area\\/plugin\\/manage","time":"21:36"},{"path":"\\/client-area\\/plugin","time":"21:43"},{"path":"\\/client-area\\/plugin\\/manage","time":"21:46"},{"path":"\\/client-area\\/plugin","time":"21:48"},{"path":"\\/client-area\\/plugin\\/manage","time":"21:53"},{"path":"\\/client-area\\/plugin","time":"21:53"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:03"},{"path":"\\/client-area\\/plugin","time":"22:12"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:17"},{"path":"\\/catalog","time":"22:28"},{"path":"\\/saas-marketplace","time":"22:29"},{"path":"\\/saas\\/chatbot-plugin","time":"22:29"},{"path":"\\/cart","time":"22:29"},{"path":"\\/catalog","time":"22:29"},{"path":"\\/saas-marketplace","time":"22:29"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"22:29"},{"path":"\\/cart","time":"22:29"},{"path":"\\/checkout","time":"22:29"},{"path":"\\/order\\/instruction\\/44","time":"22:29"},{"path":"\\/client-area","time":"22:29"},{"path":"\\/client-area\\/products","time":"22:29"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:29"},{"path":"\\/client-area\\/plugin","time":"22:29"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:30"},{"path":"\\/client-area\\/plugin","time":"22:30"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:32"},{"path":"\\/client-area\\/plugin","time":"22:32"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:37"},{"path":"\\/client-area\\/plugin","time":"22:50"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:50"},{"path":"\\/client-area\\/plugin","time":"22:51"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:52"}]	2026-07-15 20:47:24	2026-07-15 22:52:30
839	D1OAXQEdsZQIaUnYllu0FCRKPA87iA2weL2OkKgf	66.249.71.128	2026-07-17	[{"path":"\\/","time":"18:01"}]	2026-07-17 18:01:01	2026-07-17 18:01:01
831	uA4RJblgpZmcMwrnfN1zZmvNG1xNKVF6HwMvYHwz	103.152.239.14	2026-07-15	[{"path":"\\/","time":"22:53"},{"path":"\\/login","time":"22:53"}]	2026-07-15 22:53:20	2026-07-15 22:53:22
832	HBevSzCOfsVIC8WVXm1mzK9BMBIHvEu8bXhFmani	103.152.239.14	2026-07-15	[{"path":"\\/","time":"22:53"},{"path":"\\/login","time":"22:53"}]	2026-07-15 22:53:53	2026-07-15 22:53:56
840	0kDc99TaIFK4AgQ7Gep8w0ORyWlOjWufqbxYTwDB	66.249.71.128	2026-07-17	[{"path":"\\/","time":"18:01"}]	2026-07-17 18:01:01	2026-07-17 18:01:01
841	F4kw9HMaR89hLSAoX4sZTD1kIAtJXWt3pqyk8usp	104.232.219.164	2026-07-17	[{"path":"\\/","time":"19:51"}]	2026-07-17 19:51:35	2026-07-17 19:51:35
833	tOP6c0SIUB26ifJgZVn1yGnRCx49Yp5JmxOZhfj3	103.152.239.14	2026-07-15	[{"path":"\\/","time":"22:54"},{"path":"\\/catalog","time":"22:54"},{"path":"\\/saas-marketplace","time":"22:54"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"22:54"},{"path":"\\/cart","time":"22:54"},{"path":"\\/checkout","time":"22:54"},{"path":"\\/order\\/instruction\\/45","time":"22:54"},{"path":"\\/client-area\\/invoices","time":"22:54"},{"path":"\\/client-area\\/plugin","time":"22:55"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:56"}]	2026-07-15 22:54:10	2026-07-15 22:56:00
842	eARznK8Rz09X510zRqufKgheRAEN6F7FT8cHtUFm	17.22.245.162	2026-07-18	[{"path":"\\/contact","time":"16:44"}]	2026-07-18 16:44:34	2026-07-18 16:44:34
834	N5aJfUMfxG22d5Xx1TI9t8ENmQy3LabOUmXOd9R9	124.158.190.18	2026-07-16	[{"path":"\\/","time":"08:21"},{"path":"\\/services","time":"08:21"},{"path":"\\/catalog","time":"08:21"}]	2026-07-16 08:21:17	2026-07-16 08:21:28
843	e9Em9Ybd890Q9zSUKO9VMdQEACT7vEygxymTaSZE	38.147.191.45	2026-07-18	[{"path":"\\/vps-hosting","time":"17:45"}]	2026-07-18 17:45:23	2026-07-18 17:45:23
835	OHUKnyQxuWvcltErWE7VtdxViRcs0Yizlfktv6a7	103.130.116.39	2026-07-16	[{"path":"\\/","time":"14:38"},{"path":"\\/catalog","time":"14:38"}]	2026-07-16 14:38:08	2026-07-16 14:38:32
836	2TrjauhKroP82gFN8cYFNkcKcXgGiQinwl24VBwv	138.201.139.190	2026-07-16	[{"path":"\\/","time":"14:48"}]	2026-07-16 14:48:47	2026-07-16 14:48:47
837	JwZ3BcunTBPgEmo2Rms5xBZwpWMfzABfi8l9TJUM	66.249.79.7	2026-07-17	[{"path":"\\/saas-marketplace","time":"01:54"}]	2026-07-17 01:54:13	2026-07-17 01:54:13
838	6MvH72CjYCa3MVeY1jl8Klsi8cUufXmgVhI2Ow6q	66.249.79.37	2026-07-17	[{"path":"\\/","time":"02:00"}]	2026-07-17 02:00:46	2026-07-17 02:00:46
844	oAI4wbuG8ETDtZRJpnJVFGycSFzu66BmLr1Ajiz0	103.147.8.19	2026-07-18	[{"path":"\\/","time":"18:45"}]	2026-07-18 18:45:53	2026-07-18 18:45:53
845	9Y0ZStbC2IGbRnBAx8s4HSBUMSeAvWAa9dR7NFFe	40.77.167.247	2026-07-19	[{"path":"\\/","time":"06:23"}]	2026-07-19 06:23:17	2026-07-19 06:23:17
846	IouMTlIVRIx5fjsQVL5Y90l96Vh52GuXulS9DTpR	182.253.124.251	2026-07-19	[{"path":"\\/","time":"11:50"}]	2026-07-19 11:50:07	2026-07-19 11:50:07
847	rBYs8ctSX3mkhpg4HvWlQ3b7Fo1gxux33KU2qg77	182.253.124.251	2026-07-19	[{"path":"\\/","time":"11:52"}]	2026-07-19 11:52:05	2026-07-19 11:52:05
848	BkH3znR9h9P5LrDxnh5iemzwPb6SmXdTY2nZpujd	66.249.79.36	2026-07-19	[{"path":"\\/login","time":"13:39"}]	2026-07-19 13:39:41	2026-07-19 13:39:41
849	NbRNI3TpOD7jDP8nUThuWCXnpUopOQR9djsujDBt	182.8.229.9	2026-07-19	[{"path":"\\/","time":"21:03"}]	2026-07-19 21:03:21	2026-07-19 21:03:21
850	kL4YC05sMUEMrnH5Y1mQqQvhMD0cDGgpK3Q1avuF	173.252.87.1	2026-07-20	[{"path":"\\/","time":"18:22"}]	2026-07-20 18:22:21	2026-07-20 18:22:21
851	DIVmu3i5nMToDE6SnezaregYQGZ7Q9Cif6lO883q	173.252.87.18	2026-07-20	[{"path":"\\/","time":"18:22"}]	2026-07-20 18:22:22	2026-07-20 18:22:22
852	jwAWX3W3rgTt2vOs9Qllp33u52KtwtVXX4N5Ylgj	66.249.79.7	2026-07-21	[{"path":"\\/","time":"07:51"}]	2026-07-21 07:51:48	2026-07-21 07:51:48
853	bBSv8RjHUtuqp8TFsVXhzAnlg222CgoluCmMOeel	66.249.79.1	2026-07-21	[{"path":"\\/","time":"13:40"}]	2026-07-21 13:40:56	2026-07-21 13:40:57
854	N8uzHvSoy4igXab9sl5Vkmd0BIBOLNBIQY0xde88	66.249.79.8	2026-07-21	[{"path":"\\/","time":"13:41"}]	2026-07-21 13:41:04	2026-07-21 13:41:04
855	pLnux8N8C6gL3HdHYONR72ZxPsqKtIwzoMBzS1Dn	66.249.79.1	2026-07-21	[{"path":"\\/","time":"13:41"}]	2026-07-21 13:41:04	2026-07-21 13:41:04
856	BaIXtfEtgCrVXVbQf96WbycnB1fMV71gMSAvTXs9	182.253.150.3	2026-07-21	[{"path":"\\/","time":"14:10"}]	2026-07-21 14:10:50	2026-07-21 14:10:50
857	FwlEo168yqB6QWINdz6MhXiEUis9lFodlNawzEM3	52.167.144.229	2026-07-21	[{"path":"\\/about-us","time":"14:27"}]	2026-07-21 14:27:44	2026-07-21 14:27:44
858	JaKteYnyV91gid7gsVjuJQq5hIeYgt5q36w6aCPs	66.249.79.8	2026-07-21	[{"path":"\\/contact","time":"18:50"}]	2026-07-21 18:50:17	2026-07-21 18:50:17
859	YOzSl7IObOIlhAu0eJo80JanOxcvtbJgEq7SWqcN	182.253.150.3	2026-07-21	[{"path":"\\/","time":"20:03"}]	2026-07-21 20:03:09	2026-07-21 20:03:09
860	m4hhWFP39anDQcvZZ1xX0jbIZWDp5YYpY8Ltpmrd	66.249.71.129	2026-07-22	[{"path":"\\/about-us","time":"01:35"}]	2026-07-22 01:35:48	2026-07-22 01:35:48
861	eMRU17ePZcM4u7eo8ecg2lFbqEKIVjIJsKguRp4e	66.249.79.1	2026-07-22	[{"path":"\\/vps-hosting","time":"06:50"}]	2026-07-22 06:50:00	2026-07-22 06:50:00
862	zWybiJNLFOIJfkdob450gy0xrLak5x5G7npy8P8h	182.8.255.31	2026-07-22	[{"path":"\\/","time":"10:01"},{"path":"\\/about-us","time":"10:01"},{"path":"\\/","time":"10:14"}]	2026-07-22 10:01:17	2026-07-22 10:14:15
863	C1FF1kXxypdAnzjoTRgIDnYmE3FZ0HthR1EE1Wbq	38.43.64.37	2026-07-22	[{"path":"\\/","time":"10:27"}]	2026-07-22 10:27:14	2026-07-22 10:27:14
864	YdiGS3BEgMLCikIZ6sVOcy9DIVb4QXEG66PnDk7I	117.103.171.6	2026-07-22	[{"path":"\\/","time":"10:27"}]	2026-07-22 10:27:31	2026-07-22 10:27:31
865	yxy6qe7yeyq5J9FPo38CnXvHCUNPTKyHROHhwlKs	66.249.79.7	2026-07-23	[{"path":"\\/login","time":"09:56"}]	2026-07-23 09:56:32	2026-07-23 09:56:32
970	Zq3F8H4uJG0PyVoeTHcdTVcNIiMFiHlmUkaSvu5o	182.8.255.157	2026-08-04	[{"path":"\\/","time":"22:48"},{"path":"\\/profile","time":"22:48"},{"path":"\\/","time":"22:49"},{"path":"\\/catalog","time":"22:49"},{"path":"\\/services","time":"22:49"},{"path":"\\/about-us","time":"22:49"},{"path":"\\/contact","time":"22:49"},{"path":"\\/faq","time":"22:49"},{"path":"\\/client-area","time":"22:49"},{"path":"\\/client-area\\/saas","time":"22:49"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:49"},{"path":"\\/client-area\\/plugin","time":"22:51"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:52"},{"path":"\\/client-area\\/plugin","time":"22:52"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:52"},{"path":"\\/client-area\\/domain","time":"22:53"},{"path":"\\/client-area\\/hosting","time":"22:53"},{"path":"\\/client-area\\/vps","time":"22:53"},{"path":"\\/client-area\\/saas","time":"22:53"},{"path":"\\/client-area\\/invoices","time":"22:53"},{"path":"\\/client-area","time":"22:53"},{"path":"\\/client-area\\/plugin\\/manage","time":"22:54"}]	2026-08-04 22:48:44	2026-08-04 22:54:12
1020	K32tjm1bJhSbhj4iIZK1MAJucLYqQLArRNmA3WIC	103.18.34.207	2026-08-10	[{"path":"\\/","time":"15:51"},{"path":"\\/client-area","time":"15:57"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:57"},{"path":"\\/client-area","time":"15:58"},{"path":"\\/","time":"15:58"},{"path":"\\/services","time":"15:58"},{"path":"\\/about-us","time":"15:58"},{"path":"\\/contact","time":"15:58"},{"path":"\\/faq","time":"15:59"},{"path":"\\/","time":"15:59"},{"path":"\\/join-partner","time":"15:59"},{"path":"\\/client-area","time":"16:14"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:14"}]	2026-08-10 15:51:44	2026-08-10 16:14:41
991	cSlWUI4YyqH4uo4VH0feWDOPzn4PG0GyxMriPTMP	103.18.34.205	2026-08-06	[{"path":"\\/","time":"11:13"},{"path":"\\/client-area","time":"11:13"},{"path":"\\/client-area\\/plugin\\/manage","time":"11:13"}]	2026-08-06 11:13:43	2026-08-06 11:13:49
1004	rQ7QI81z464QnELoBPLeNKbIM494QhoKnHM9BPlK	140.213.161.89	2026-08-08	[{"path":"\\/","time":"08:18"}]	2026-08-08 08:18:07	2026-08-08 08:18:07
1036	ucRfVJ3pnR3tdaLuylWBhIoTqtavXIqdIYfHkrFj	182.8.255.93	2026-08-11	[{"path":"\\/","time":"05:15"},{"path":"\\/about-us","time":"05:16"}]	2026-08-11 05:15:54	2026-08-11 05:16:20
1052	J81p8VQv4qv8pbIs3e1Pd8mKB925dTbOnWnwhLb5	74.7.241.26	2026-08-12	[{"path":"\\/","time":"12:30"}]	2026-08-12 12:30:11	2026-08-12 12:30:11
1067	JqGyHXzgeDouqNXPMfVGOsKLloe43xD2HvXIqJVE	82.158.131.175	2026-08-12	[{"path":"\\/login","time":"18:01"}]	2026-08-12 18:01:07	2026-08-12 18:01:07
1165	hvQkvCKzaYtffzqnSf0HITqCFEZN6Gbq1lKWOybT	66.249.71.97	2026-08-23	[{"path":"\\/cpanel-hosting","time":"18:29"}]	2026-08-23 18:29:35	2026-08-23 18:29:35
1081	Tvj4IX9nA4tRD1gjPkBMPs15o6S5Zkn4wwWXGS49	82.158.131.175	2026-08-13	[{"path":"\\/","time":"13:04"},{"path":"\\/catalog","time":"13:04"},{"path":"\\/saas-marketplace","time":"13:04"}]	2026-08-13 13:04:31	2026-08-13 13:04:42
1084	t8YCdx7rfPJMMo0skIbTxCVqE1vTyE5CWckZJJrt	182.8.229.188	2026-08-13	[{"path":"\\/","time":"16:37"},{"path":"\\/about-us","time":"16:37"},{"path":"\\/","time":"16:48"},{"path":"\\/services","time":"16:48"},{"path":"\\/","time":"16:48"},{"path":"\\/saas-marketplace","time":"16:53"},{"path":"\\/saas\\/chatbot-plugin","time":"17:28"},{"path":"\\/saas\\/monitoring-visitor-plugin","time":"17:28"}]	2026-08-13 16:37:17	2026-08-13 17:28:59
1182	0ZoEQe5gvtJR0kn80JX4QyjecSKUCe7iUgnj0WD9	66.249.68.128	2026-08-25	[{"path":"\\/domain-registration","time":"12:59"}]	2026-08-25 12:59:24	2026-08-25 12:59:24
1199	nzrLpHEa3b8NpQzpBHe3w0q65lzLqEJL27EBrBSi	66.249.71.170	2026-08-28	[{"path":"\\/","time":"05:50"}]	2026-08-28 05:50:13	2026-08-28 05:50:13
1214	F5HIDRMb80CPCaBwJtvdPaWsFk0DPjASAUreG1fX	173.252.87.112	2026-08-29	[{"path":"\\/","time":"15:56"}]	2026-08-29 15:56:19	2026-08-29 15:56:19
1228	fnmFpLCwu6o0NCjK4kfgCq1QQEcArNyErpraYHA3	103.147.8.141	2026-08-31	[{"path":"\\/client-area","time":"20:38"},{"path":"\\/client-area\\/plugin\\/manage","time":"20:38"}]	2026-08-31 20:38:50	2026-08-31 20:38:58
1242	cGxhv7n6F84ABEyVOARiXOERllKRUVn9EETqTlzD	110.138.127.213	2026-09-01	[{"path":"\\/about-us","time":"11:16"},{"path":"\\/contact","time":"11:16"},{"path":"\\/about-us","time":"11:16"}]	2026-09-01 11:16:04	2026-09-01 11:16:41
1256	lr6AFhw32U1u5GNTVcssvYrqjqZVSgoIvARuMlqh	202.152.21.158	2026-09-02	[{"path":"\\/","time":"15:22"}]	2026-09-02 15:22:43	2026-09-02 15:22:43
1269	6vEmamoqjr0MtbHPj4OK5Nl6zBvj89BQFOoeJBCn	125.160.19.97	2026-09-03	[{"path":"\\/","time":"23:25"}]	2026-09-03 23:25:44	2026-09-03 23:25:44
1283	2VFEqTxeBKcGQjVSroQVquCaQ4DFNgAEsuiAKGsB	173.252.87.46	2026-09-06	[{"path":"\\/","time":"07:19"}]	2026-09-06 07:19:04	2026-09-06 07:19:04
976	3lSQr3NuNCfFyrliNuNtFLROUKB7D8y7GPDkCt0O	112.215.224.200	2026-08-05	[{"path":"\\/","time":"10:09"},{"path":"\\/login","time":"10:09"}]	2026-08-05 10:09:09	2026-08-05 10:09:15
992	J13TWAhGQvPSyFgYe2OklE3NAYzU3YEZoTzkRdEa	203.78.124.100	2026-08-06	[{"path":"\\/","time":"11:54"}]	2026-08-06 11:54:41	2026-08-06 11:54:41
1005	ABtMIUnmF85WhYnacKreZA5C9gkaDVarZzW3poaV	103.18.34.207	2026-08-08	[{"path":"\\/","time":"15:13"}]	2026-08-08 15:13:49	2026-08-08 15:13:49
1021	MWWidOXpBWclfnorxfrO73hlgLgMOiQGwqTUh0QQ	66.249.68.128	2026-08-10	[{"path":"\\/","time":"16:01"}]	2026-08-10 16:01:40	2026-08-10 16:01:40
1037	dyGCHwPxAOVbH6kIb1Y40eEUEpI7RqLZglP8xtiU	112.215.171.99	2026-08-11	[{"path":"\\/","time":"06:29"}]	2026-08-11 06:29:34	2026-08-11 06:29:34
1053	0ztlhkSnu0YMKh9uLfC3YDlDrlc6EvMC0BjSWMiS	82.158.131.175	2026-08-12	[{"path":"\\/","time":"13:47"},{"path":"\\/login","time":"13:48"}]	2026-08-12 13:47:57	2026-08-12 13:48:00
1068	KZIfvMM6FveJCcbTE9rgHHwb46wqLQHeFbYyyrRv	82.158.131.175	2026-08-12	[{"path":"\\/client-area\\/plugin\\/manage","time":"18:01"}]	2026-08-12 18:01:25	2026-08-12 18:01:25
1089	xOkG4AOgRpdEUr9vRh0rVDP3fL7SD0ILb9xDiPmK	173.252.87.7	2026-08-13	[{"path":"\\/","time":"22:06"}]	2026-08-13 22:06:01	2026-08-13 22:06:01
1149	5CRkpLIEtPDzN4Bydn1WZZs7gO7w1SBYJEkZPHHi	66.249.66.74	2026-08-22	[{"path":"\\/","time":"11:05"}]	2026-08-22 11:05:10	2026-08-22 11:05:10
1166	cwT1tllPbzA5c18B11jDJstdSUyGY6Zue5JRu7Qa	118.137.229.38	2026-08-23	[{"path":"\\/","time":"18:46"}]	2026-08-23 18:46:04	2026-08-23 18:46:04
1183	ucZJutFVfrJjJM9dZY45R2bfAeuk7aIq8pnsYr80	17.246.15.202	2026-08-25	[{"path":"\\/domain-registration","time":"13:35"}]	2026-08-25 13:35:31	2026-08-25 13:35:31
1200	xtWC639mdNkxburqRuNUW7igaOAAXY4GTfii2mO3	66.249.64.171	2026-08-28	[{"path":"\\/login","time":"09:08"}]	2026-08-28 09:08:21	2026-08-28 09:08:23
1215	u1HxSZJtOLPU1kHKJp2gFxL9aPrR1qUl3Gr6pup8	17.166.21.147	2026-08-30	[{"path":"\\/domain-registration","time":"06:20"}]	2026-08-30 06:20:49	2026-08-30 06:20:50
1229	mMGqzXodjo4Vi9wLr0ZLPwdiudHH1M69FNFUDMuP	103.147.8.141	2026-08-31	[{"path":"\\/","time":"20:44"},{"path":"\\/login","time":"20:44"}]	2026-08-31 20:44:54	2026-08-31 20:44:58
1243	ihDDOcBwYQqLGl2ujiKpz62rdcDzqFsB8QgceTfJ	140.213.24.223	2026-09-01	[{"path":"\\/","time":"15:10"},{"path":"\\/login","time":"15:10"}]	2026-09-01 15:10:00	2026-09-01 15:10:11
1257	NA5NbZfY8ZSJjpnQC2ffjHdpP6HF16iEQqMZtMxo	202.180.25.34	2026-09-02	[{"path":"\\/domain-registration","time":"15:22"},{"path":"\\/catalog","time":"15:22"},{"path":"\\/services","time":"15:23"}]	2026-09-02 15:22:50	2026-09-02 15:23:09
1270	g5lS8G6HyzUbxjPmxd5be68moU3g5FWvCXplgxaZ	74.7.243.20	2026-09-04	[{"path":"\\/domain-registration","time":"00:17"}]	2026-09-04 00:17:23	2026-09-04 00:17:23
1284	1kwUTaXRvuBpwnJIjCtbw7DGfwTEOr1lpfQBo111	52.167.144.211	2026-09-06	[{"path":"\\/order\\/vps","time":"10:03"}]	2026-09-06 10:03:54	2026-09-06 10:03:55
954	SQmQaEcpoUqlVeBjTbTz0jz0wcX4Ng1etrx29fYO	103.147.8.19	2026-08-04	[{"path":"\\/","time":"16:32"},{"path":"\\/login","time":"16:32"}]	2026-08-04 16:32:50	2026-08-04 16:32:52
947	hHzMzVQ9cKW2vv8Z8kIeHA9naxRF1siYRckQ0FMw	103.147.8.19	2026-08-04	[{"path":"\\/","time":"13:43"},{"path":"\\/login","time":"13:43"},{"path":"\\/register","time":"13:44"},{"path":"\\/login","time":"13:44"},{"path":"\\/forgot-password","time":"13:45"},{"path":"\\/login","time":"13:45"}]	2026-08-04 13:43:56	2026-08-04 13:45:12
945	LKdnjhtxelO1UKb7WfgZt4JvTGX2C6ZBI9UB5GdH	66.249.68.129	2026-08-04	[{"path":"\\/","time":"13:30"}]	2026-08-04 13:30:28	2026-08-04 13:30:28
939	BYHPRwH3LMG7xZmyNOFXYtku3SIo9LNwAbwqf2dF	103.147.8.19	2026-08-04	[{"path":"\\/","time":"10:27"},{"path":"\\/login","time":"10:27"},{"path":"\\/forgot-password","time":"10:28"},{"path":"\\/register","time":"10:28"},{"path":"\\/login","time":"10:29"},{"path":"\\/","time":"10:29"},{"path":"\\/login","time":"10:49"},{"path":"\\/register","time":"10:49"},{"path":"\\/login","time":"10:49"},{"path":"\\/forgot-password","time":"10:49"},{"path":"\\/login","time":"10:51"},{"path":"\\/register","time":"11:02"},{"path":"\\/forgot-password","time":"11:02"},{"path":"\\/reset-password\\/364ef97ce5cc172c0f446238797e3c5b03f7a02b8a14f8ce5e8022fe308f85b0","time":"11:02"},{"path":"\\/login","time":"11:03"},{"path":"\\/register","time":"11:04"},{"path":"\\/login","time":"11:04"},{"path":"\\/register","time":"11:11"},{"path":"\\/login","time":"11:11"},{"path":"\\/register","time":"12:35"},{"path":"\\/login","time":"12:35"},{"path":"\\/forgot-password","time":"12:36"},{"path":"\\/","time":"12:36"},{"path":"\\/login","time":"12:36"},{"path":"\\/","time":"12:37"},{"path":"\\/login","time":"12:37"},{"path":"\\/register","time":"12:40"},{"path":"\\/login","time":"12:40"},{"path":"\\/forgot-password","time":"12:40"},{"path":"\\/","time":"12:41"},{"path":"\\/login","time":"12:42"},{"path":"\\/register","time":"12:42"},{"path":"\\/login","time":"12:43"},{"path":"\\/register","time":"12:44"},{"path":"\\/login","time":"12:44"},{"path":"\\/","time":"12:44"},{"path":"\\/login","time":"12:44"},{"path":"\\/catalog","time":"12:45"},{"path":"\\/services","time":"12:45"},{"path":"\\/about-us","time":"12:45"},{"path":"\\/contact","time":"12:45"},{"path":"\\/faq","time":"12:45"},{"path":"\\/","time":"12:45"},{"path":"\\/login","time":"12:46"},{"path":"\\/register","time":"12:46"},{"path":"\\/login","time":"12:46"},{"path":"\\/forgot-password","time":"12:46"},{"path":"\\/login","time":"12:46"},{"path":"\\/","time":"12:52"},{"path":"\\/services","time":"12:53"},{"path":"\\/about-us","time":"12:53"},{"path":"\\/catalog","time":"12:53"},{"path":"\\/saas-marketplace","time":"12:53"},{"path":"\\/","time":"12:53"},{"path":"\\/services","time":"12:53"},{"path":"\\/about-us","time":"12:54"},{"path":"\\/contact","time":"12:54"},{"path":"\\/faq","time":"12:54"},{"path":"\\/contact","time":"12:54"},{"path":"\\/about-us","time":"12:54"},{"path":"\\/services","time":"12:54"},{"path":"\\/","time":"12:54"},{"path":"\\/portfolio","time":"12:54"},{"path":"\\/contact","time":"12:54"},{"path":"\\/services","time":"12:59"},{"path":"\\/about-us","time":"12:59"},{"path":"\\/","time":"13:00"},{"path":"\\/login","time":"13:00"}]	2026-08-04 10:27:18	2026-08-04 13:00:13
946	2iXIdeTn4po0NkMHedOEusvLp1ddb9jIZoRBqpu4	103.147.8.19	2026-08-04	[{"path":"\\/profile","time":"13:31"}]	2026-08-04 13:31:47	2026-08-04 13:31:47
962	zvm8OwTH0wLkwVNe3tD74AjgtsCXAVTgq2oo1KJ4	173.252.87.114	2026-08-04	[{"path":"\\/","time":"17:36"}]	2026-08-04 17:36:27	2026-08-04 17:36:27
944	NeY7efuvYL4QOWQxEhQk5t5Lq73JlX9V8f4nbtHm	103.147.8.19	2026-08-04	[{"path":"\\/","time":"13:00"},{"path":"\\/client-area","time":"13:00"},{"path":"\\/partner-area\\/dashboard","time":"13:00"},{"path":"\\/cart","time":"13:00"},{"path":"\\/profile","time":"13:00"},{"path":"\\/","time":"13:02"},{"path":"\\/client-area","time":"13:04"},{"path":"\\/client-area\\/profile","time":"13:04"},{"path":"\\/","time":"13:04"},{"path":"\\/profile","time":"13:04"},{"path":"\\/partner-area\\/dashboard","time":"13:05"},{"path":"\\/","time":"13:05"},{"path":"\\/about-us","time":"13:19"},{"path":"\\/services","time":"13:19"},{"path":"\\/profile","time":"13:19"},{"path":"\\/client-area","time":"13:19"},{"path":"\\/client-area\\/profile","time":"13:19"},{"path":"\\/","time":"13:19"},{"path":"\\/profile","time":"13:19"},{"path":"\\/","time":"13:22"},{"path":"\\/client-area","time":"13:22"},{"path":"\\/client-area\\/plugin\\/manage","time":"13:22"},{"path":"\\/client-area","time":"13:43"},{"path":"\\/","time":"13:43"}]	2026-08-04 13:00:21	2026-08-04 13:43:47
960	NXlUofppAksgppyfbo4OE8vWEqzRavoWkiIWsZQt	114.10.7.246	2026-08-04	[{"path":"\\/","time":"17:09"},{"path":"\\/login","time":"17:09"}]	2026-08-04 17:09:04	2026-08-04 17:09:07
955	rE1TdJ0PHksdGCXMhl5a5s4DWlLqVgmgzvGzFfot	103.147.8.19	2026-08-04	[{"path":"\\/","time":"16:33"},{"path":"\\/client-area","time":"16:33"},{"path":"\\/profile","time":"16:33"},{"path":"\\/","time":"16:33"}]	2026-08-04 16:33:05	2026-08-04 16:33:41
948	I3AuU2hsQmDjEauG7lMEwuwkOO4LdkyNthcblXF7	103.147.8.19	2026-08-04	[{"path":"\\/","time":"14:37"},{"path":"\\/client-area","time":"14:37"},{"path":"\\/client-area\\/plugin\\/manage","time":"14:37"},{"path":"\\/client-area\\/plugin","time":"14:44"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:25"}]	2026-08-04 14:37:43	2026-08-04 15:25:02
963	ubn2PvFDjhgttqiOVsEhZBcwFHrXUXDiDhsCGgDX	173.252.87.18	2026-08-04	[{"path":"\\/","time":"17:36"}]	2026-08-04 17:36:29	2026-08-04 17:36:29
956	oTbS5sWpC8jIZqgLAmgYvlqIeFE8O7xkOXR2zHDU	103.147.8.19	2026-08-04	[{"path":"\\/","time":"16:33"},{"path":"\\/login","time":"16:34"},{"path":"\\/forgot-password","time":"16:34"}]	2026-08-04 16:33:59	2026-08-04 16:34:06
949	LcuNoM18Oj4lUz846rOUTeyBIZCnnm6SwJdvA7Eq	103.147.8.19	2026-08-04	[{"path":"\\/admin\\/dashboard","time":"15:36"},{"path":"\\/admin\\/monitoring","time":"15:36"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:40"},{"path":"\\/admin\\/monitoring","time":"15:54"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:58"}]	2026-08-04 15:36:33	2026-08-04 15:58:27
950	kIj40p35cpiF81wkQAJhx0dqvjJaf5uACbqzHYsu	182.253.14.162	2026-08-04	[{"path":"\\/","time":"16:21"}]	2026-08-04 16:21:08	2026-08-04 16:21:08
951	FaKTfX1Vtt7c8yMAHP3jWa6iA1TtWPhSNOCbpHRI	103.147.8.19	2026-08-04	[{"path":"\\/","time":"16:32"}]	2026-08-04 16:32:08	2026-08-04 16:32:08
952	ZcYny7h4hbYV5NhsJ4hsalaJGKgoboo85jW2DgnC	103.147.8.19	2026-08-04	[{"path":"\\/","time":"16:32"},{"path":"\\/login","time":"16:32"}]	2026-08-04 16:32:25	2026-08-04 16:32:28
953	5yfS4zfcVV6e6UBAtTjTx0vPHGg0JnMo5aR4yrkL	103.147.8.19	2026-08-04	[{"path":"\\/","time":"16:32"}]	2026-08-04 16:32:46	2026-08-04 16:32:46
964	yRV25RStNSuSnngm7q0h0LFIrRUdvzFswPRBlmnt	173.252.87.113	2026-08-04	[{"path":"\\/","time":"17:36"}]	2026-08-04 17:36:31	2026-08-04 17:36:31
957	YQUX23oQwzBWLtCl4KEIVKhQXOwOSf6oUeC34muG	103.147.8.19	2026-08-04	[{"path":"\\/reset-password\\/c2deb5369e6371866547a961b743110bf78dea55dd2603928a9962a60ebceabf","time":"16:34"},{"path":"\\/login","time":"16:41"}]	2026-08-04 16:34:45	2026-08-04 16:41:09
961	0xzVgnGdf9qD90DMqEmGt2boqiyfkdp8FIn4Fcf5	114.10.7.246	2026-08-04	[{"path":"\\/","time":"17:09"},{"path":"\\/client-area","time":"17:09"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:10"},{"path":"\\/client-area\\/vps","time":"17:13"},{"path":"\\/client-area\\/hosting","time":"17:13"}]	2026-08-04 17:09:52	2026-08-04 17:13:12
958	WfBDHzyngoZlNHehhQOZC8BlchTTZgRQjV5oeMOC	103.147.8.19	2026-08-04	[{"path":"\\/","time":"16:41"},{"path":"\\/client-area","time":"16:41"},{"path":"\\/client-area\\/plugin","time":"16:41"},{"path":"\\/client-area\\/plugin\\/manage","time":"16:41"},{"path":"\\/client-area\\/plugin","time":"17:19"},{"path":"\\/client-area\\/plugin\\/manage","time":"17:19"}]	2026-08-04 16:41:19	2026-08-04 17:19:41
965	rGwhSmkJW29TL88tjNHGoHggk2XpPK5LgBbuIOyV	66.249.68.130	2026-08-04	[{"path":"\\/","time":"18:19"}]	2026-08-04 18:19:27	2026-08-04 18:19:27
959	Ob700f3LblXhZ2GcbCf9ylNHEOfUq1dkQwTSRe62	66.249.66.202	2026-08-04	[{"path":"\\/login","time":"17:07"}]	2026-08-04 17:07:18	2026-08-04 17:07:18
966	7xVv4YK879lCSJBGZzbck3n9Eqt9zxOCfDNvUlMC	66.249.68.130	2026-08-04	[{"path":"\\/","time":"18:19"}]	2026-08-04 18:19:27	2026-08-04 18:19:27
968	vWfI8TSOFYQ4TsOTWBm6HiIdsuIdA68fqi3IxyMo	66.249.68.129	2026-08-04	[{"path":"\\/contact","time":"19:35"}]	2026-08-04 19:35:37	2026-08-04 19:35:37
967	urh3FwQd6WUYW0QW3hAyR24rWaMJLEgmhn5XWIQr	182.8.98.138	2026-08-04	[{"path":"\\/","time":"18:40"},{"path":"\\/catalog","time":"18:40"},{"path":"\\/services","time":"18:40"},{"path":"\\/about-us","time":"18:40"},{"path":"\\/contact","time":"18:41"}]	2026-08-04 18:40:03	2026-08-04 18:41:04
969	HxTlr2DHVYFr9dpMqTl8Z69kTvmEH4dpA92LmAp1	182.8.255.157	2026-08-04	[{"path":"\\/","time":"22:47"},{"path":"\\/login","time":"22:48"}]	2026-08-04 22:47:37	2026-08-04 22:48:29
971	jx5HJx7HoUVAD1OVLTkxuyGlGfVrwdsdRGPfCVSn	114.10.7.246	2026-08-05	[{"path":"\\/","time":"08:39"}]	2026-08-05 08:39:44	2026-08-05 08:39:44
972	nQetE2Y3htNMolsCH5GqmKaGdmMucJXYwskbaMCY	182.8.255.157	2026-08-05	[{"path":"\\/login","time":"08:50"}]	2026-08-05 08:50:04	2026-08-05 08:50:04
973	cbbi7NdHqb9kQhpCq1VVjcDwyqLDfHmw0yMubMuF	182.8.255.157	2026-08-05	[{"path":"\\/client-area\\/plugin\\/manage","time":"08:51"}]	2026-08-05 08:51:04	2026-08-05 08:51:04
974	SQq7GSozkurcncx19K0WKciqlWMM7D6B6EnMThDS	114.10.7.246	2026-08-05	[{"path":"\\/login","time":"08:57"}]	2026-08-05 08:57:55	2026-08-05 08:57:55
975	j7QhvfgSkMiTTRE5TjWqQP9BOPG6wA54CvHLsqt6	182.253.150.2	2026-08-05	[{"path":"\\/","time":"09:37"}]	2026-08-05 09:37:02	2026-08-05 09:37:03
1092	VvhOH7suOdq10mAtE6I3x7koldZNRPAKWeWqcfTC	82.158.131.175	2026-08-14	[{"path":"\\/admin\\/dashboard","time":"01:36"},{"path":"\\/admin\\/saas-management","time":"01:36"},{"path":"\\/admin\\/saas\\/create","time":"01:36"},{"path":"\\/admin\\/saas-management","time":"01:40"},{"path":"\\/admin\\/saas\\/create","time":"01:40"},{"path":"\\/admin\\/saas-management","time":"01:53"},{"path":"\\/admin\\/saas\\/7","time":"01:53"},{"path":"\\/admin\\/saas-management","time":"01:53"},{"path":"\\/admin\\/saas\\/7\\/edit","time":"01:53"},{"path":"\\/admin\\/saas-management","time":"01:53"},{"path":"\\/admin\\/saas\\/7\\/edit","time":"01:56"},{"path":"\\/admin\\/saas-management","time":"01:58"},{"path":"\\/admin\\/saas\\/7\\/edit","time":"01:58"},{"path":"\\/admin\\/saas-management","time":"01:58"},{"path":"\\/","time":"01:58"},{"path":"\\/services","time":"01:58"},{"path":"\\/catalog","time":"01:58"},{"path":"\\/saas-marketplace","time":"01:58"},{"path":"\\/admin\\/saas\\/7\\/edit","time":"01:59"},{"path":"\\/admin\\/saas-management","time":"01:59"},{"path":"\\/saas-marketplace","time":"02:04"},{"path":"\\/saas\\/langganan-paket-pro-smartrackid","time":"02:05"},{"path":"\\/admin\\/saas\\/create","time":"02:06"},{"path":"\\/admin\\/saas-management","time":"02:10"},{"path":"\\/admin\\/saas\\/create","time":"02:11"},{"path":"\\/admin\\/saas-management","time":"02:17"},{"path":"\\/admin\\/saas\\/create","time":"02:18"},{"path":"\\/admin\\/saas-management","time":"02:22"},{"path":"\\/saas\\/langganan-paket-pro-smartrackid","time":"02:22"},{"path":"\\/saas-marketplace","time":"02:22"},{"path":"\\/","time":"02:22"},{"path":"\\/admin\\/plugin-management","time":"02:22"},{"path":"\\/admin\\/plugin-customers","time":"02:22"},{"path":"\\/admin\\/plugin-management","time":"02:22"}]	2026-08-14 01:36:27	2026-08-14 02:22:43
1101	Rq7uGNlyggU3Nwh5DFZ8088EyvVJdgmwjOzgMQcW	66.249.68.130	2026-08-14	[{"path":"\\/","time":"18:18"}]	2026-08-14 18:18:34	2026-08-14 18:18:34
1095	R8YbjXfn8ExA5BersZlv9g6nW7xNeUeolKY4cGyk	114.10.120.82	2026-08-14	[{"path":"\\/","time":"12:07"},{"path":"\\/services","time":"12:07"},{"path":"\\/","time":"12:07"},{"path":"\\/saas-marketplace","time":"12:07"},{"path":"\\/saas\\/langganan-paket-pro-smartrackid","time":"12:08"},{"path":"\\/login","time":"12:08"},{"path":"\\/saas\\/langganan-paket-scanyukcom","time":"12:08"}]	2026-08-14 12:07:06	2026-08-14 12:08:32
1093	Qi3OHXI2zsrwtEvjuaAnlI5NH94362IzmCukxUUN	182.8.229.188	2026-08-14	[{"path":"\\/","time":"08:41"},{"path":"\\/services","time":"08:41"},{"path":"\\/about-us","time":"08:41"},{"path":"\\/contact","time":"08:41"},{"path":"\\/faq","time":"08:41"},{"path":"\\/","time":"08:54"},{"path":"\\/domain-registration","time":"08:54"},{"path":"\\/register","time":"08:56"}]	2026-08-14 08:41:17	2026-08-14 08:56:43
1102	ZxQn0aHwF2wpFgJ8o7LSUCtgdpty7OcSc10F2aOd	157.55.39.192	2026-08-14	[{"path":"\\/catalog","time":"18:19"}]	2026-08-14 18:19:01	2026-08-14 18:19:01
1098	EPlEvISsfIfoAdL9MM6OfDqnsHTYL5X2cTf5q6Ct	82.158.131.175	2026-08-14	[{"path":"\\/","time":"16:49"}]	2026-08-14 16:49:34	2026-08-14 16:49:34
1094	ja2xKkNH0eJpTNiEbd8gj034fNOar8d9O75D2HRq	182.8.229.188	2026-08-14	[{"path":"\\/","time":"08:57"},{"path":"\\/client-area","time":"08:57"},{"path":"\\/client-area\\/vps","time":"08:57"},{"path":"\\/client-area\\/saas","time":"08:57"},{"path":"\\/client-area\\/invoices","time":"08:57"}]	2026-08-14 08:57:10	2026-08-14 08:57:44
1099	KKWuHoEOniXqtEwuzqKGmOjoaIS4JLJ5pNRpt19Z	114.10.120.82	2026-08-14	[{"path":"\\/","time":"16:59"}]	2026-08-14 16:59:10	2026-08-14 16:59:10
1103	d7xCWtwhR5H7bq78NrEDQEYQFLk8e2hjnqd9jkr6	66.249.68.133	2026-08-14	[{"path":"\\/","time":"18:19"}]	2026-08-14 18:19:14	2026-08-14 18:19:14
1100	C3kesbZkXPqcEn6faVNMAjPXltLf548aBITkVuXm	114.10.120.82	2026-08-14	[{"path":"\\/","time":"16:59"},{"path":"\\/catalog","time":"16:59"},{"path":"\\/saas-marketplace","time":"16:59"}]	2026-08-14 16:59:14	2026-08-14 16:59:33
1104	ww69XVr0SKA3NDCRRRmtl9nE33NNbuElophGAQbA	66.249.68.128	2026-08-14	[{"path":"\\/","time":"18:19"}]	2026-08-14 18:19:15	2026-08-14 18:19:15
1150	DlZBSl2fJ1n4AvHv7sFJkKTK3eIi2olcr8UFQ0vr	66.249.66.33	2026-08-22	[{"path":"\\/","time":"11:05"}]	2026-08-22 11:05:11	2026-08-22 11:05:11
1258	omJltfuUyw10p7PjU9S9wzWzrfM80YPORbflE7Mc	52.167.144.16	2026-09-02	[{"path":"\\/about-us","time":"22:06"}]	2026-09-02 22:06:25	2026-09-02 22:06:25
1167	RCL5ehCOyNZq4W6Rt54RREMlpQmCFWlk1Wh32lsm	118.137.229.38	2026-08-23	[{"path":"\\/domain-registration","time":"18:46"},{"path":"\\/services","time":"18:46"},{"path":"\\/catalog","time":"18:46"},{"path":"\\/login","time":"18:47"}]	2026-08-23 18:46:16	2026-08-23 18:47:25
1184	UDPz0TFC7wPqdAemPULMjXDmpWn1lnSgImEL8tCA	66.249.68.129	2026-08-25	[{"path":"\\/order\\/cpanel","time":"15:30"}]	2026-08-25 15:30:59	2026-08-25 15:30:59
1201	qlMNubGDxSGSFJc3W525T8E6gtRKSzl9JczE1m5i	112.215.160.147	2026-08-28	[{"path":"\\/","time":"10:23"}]	2026-08-28 10:23:26	2026-08-28 10:23:27
1216	8qawRr3w5VJb03rJ5aLUMtow47anh35r8AbW9eMA	66.249.66.199	2026-08-30	[{"path":"\\/refund-policy","time":"11:44"}]	2026-08-30 11:44:05	2026-08-30 11:44:05
1271	yUiJD3yeB1r7kuLOuh1vwhACpSfnWIeXqijbMQjP	66.249.79.37	2026-09-04	[{"path":"\\/cpanel-hosting","time":"05:27"}]	2026-09-04 05:27:07	2026-09-04 05:27:07
1230	YHzUyhB6lN6xfOsH0IN7nwITbHI1PCpVoSdo5u62	103.147.8.141	2026-08-31	[{"path":"\\/","time":"20:45"},{"path":"\\/client-area","time":"20:45"},{"path":"\\/client-area\\/plugin\\/manage","time":"20:45"}]	2026-08-31 20:45:04	2026-08-31 20:45:17
1285	hCPw3XjU23XbdBra4rru11yjD0JTs8rdzEaCrdzt	66.249.66.42	2026-09-06	[{"path":"\\/vps-hosting","time":"14:18"}]	2026-09-06 14:18:58	2026-09-06 14:18:58
1244	qFLOltffoIurn4wJandug69sAkgMXBtoIfrycaPH	140.213.24.223	2026-09-01	[{"path":"\\/","time":"15:10"},{"path":"\\/client-area","time":"15:10"},{"path":"\\/client-area\\/plugin\\/manage","time":"15:10"}]	2026-09-01 15:10:21	2026-09-01 15:10:42
1202	oDxD9k2IBFrEnE2ntONmlSQNnx3zK4OGABL77LdQ	140.213.141.23	2026-08-28	[{"path":"\\/","time":"14:11"}]	2026-08-28 14:11:48	2026-08-28 14:11:48
1217	EwDOdSjQElX6i1ak1UZayojD6HDc3W0J8DdmpNA0	66.249.66.42	2026-08-30	[{"path":"\\/order\\/cpanel","time":"20:03"}]	2026-08-30 20:03:31	2026-08-30 20:03:31
1231	ZwzHNjiD290hzKVdwAWnKCHlPF1sTwl4SMnqBVjk	103.147.8.141	2026-08-31	[{"path":"\\/login","time":"20:53"}]	2026-08-31 20:53:48	2026-08-31 20:53:48
1097	EHmIkzzVvcntCZ8WPXH4IgF3NutIXls7n60eqS5v	82.158.131.175	2026-08-14	[{"path":"\\/","time":"14:08"},{"path":"\\/catalog","time":"14:08"},{"path":"\\/domain-registration","time":"14:08"},{"path":"\\/order\\/domain","time":"14:08"},{"path":"\\/cart","time":"14:08"},{"path":"\\/checkout","time":"14:10"},{"path":"\\/order\\/instruction\\/50","time":"14:10"},{"path":"\\/","time":"14:11"},{"path":"\\/notifications","time":"14:11"},{"path":"\\/catalog","time":"14:22"},{"path":"\\/","time":"14:23"},{"path":"\\/catalog","time":"16:35"},{"path":"\\/faq","time":"16:50"},{"path":"\\/cart","time":"16:51"},{"path":"\\/","time":"16:51"},{"path":"\\/about-us","time":"16:58"},{"path":"\\/partner-area\\/dashboard","time":"17:17"},{"path":"\\/partner-area\\/my-apps","time":"17:18"},{"path":"\\/partner\\/register-saas","time":"17:18"},{"path":"\\/partner-area\\/company-profile","time":"17:18"},{"path":"\\/partner-area\\/dashboard","time":"17:18"},{"path":"\\/client-area","time":"17:21"},{"path":"\\/client-area\\/invoices","time":"17:21"},{"path":"\\/order\\/instruction\\/50","time":"17:21"},{"path":"\\/client-area\\/invoices","time":"17:25"},{"path":"\\/","time":"17:27"},{"path":"\\/client-area","time":"17:46"},{"path":"\\/","time":"17:49"},{"path":"\\/cart","time":"17:55"},{"path":"\\/catalog","time":"17:55"},{"path":"\\/domain-registration","time":"17:55"},{"path":"\\/order\\/cpanel","time":"17:56"},{"path":"\\/catalog","time":"17:56"},{"path":"\\/saas-marketplace","time":"17:56"},{"path":"\\/saas\\/chatbot-plugin","time":"17:56"},{"path":"\\/cart","time":"17:56"},{"path":"\\/checkout","time":"17:56"},{"path":"\\/order\\/instruction\\/51","time":"17:56"},{"path":"\\/client-area","time":"18:04"},{"path":"\\/client-area\\/tickets","time":"19:59"},{"path":"\\/","time":"20:00"},{"path":"\\/saas-marketplace","time":"20:00"},{"path":"\\/notifications","time":"20:01"},{"path":"\\/catalog","time":"20:02"},{"path":"\\/","time":"20:06"},{"path":"\\/domain-registration","time":"20:06"},{"path":"\\/cart","time":"20:15"},{"path":"\\/","time":"20:16"},{"path":"\\/catalog","time":"20:21"},{"path":"\\/","time":"20:25"},{"path":"\\/portfolio","time":"20:43"},{"path":"\\/","time":"20:54"},{"path":"\\/cart","time":"21:17"},{"path":"\\/checkout","time":"21:17"},{"path":"\\/order\\/instruction\\/52","time":"21:17"},{"path":"\\/","time":"21:20"},{"path":"\\/client-area","time":"21:24"},{"path":"\\/client-area\\/tickets","time":"21:24"},{"path":"\\/client-area","time":"21:25"},{"path":"\\/client-area\\/tickets","time":"21:31"},{"path":"\\/client-area","time":"21:34"},{"path":"\\/","time":"21:34"},{"path":"\\/catalog","time":"21:49"},{"path":"\\/order\\/cpanel","time":"21:49"},{"path":"\\/order\\/vps","time":"21:50"},{"path":"\\/catalog","time":"21:50"},{"path":"\\/order\\/vps","time":"21:50"},{"path":"\\/","time":"21:51"},{"path":"\\/cpanel-hosting","time":"21:51"},{"path":"\\/","time":"21:52"},{"path":"\\/cpanel-hosting","time":"21:52"},{"path":"\\/vps-hosting","time":"21:52"},{"path":"\\/cpanel-hosting","time":"21:53"},{"path":"\\/client-area","time":"21:54"},{"path":"\\/client-area\\/tickets","time":"21:54"},{"path":"\\/client-area\\/tickets\\/create","time":"21:54"},{"path":"\\/client-area\\/tickets","time":"21:55"},{"path":"\\/","time":"21:55"},{"path":"\\/domain-registration","time":"22:11"},{"path":"\\/portfolio","time":"22:13"},{"path":"\\/","time":"22:14"},{"path":"\\/client-area","time":"22:14"},{"path":"\\/client-area\\/tickets","time":"22:14"},{"path":"\\/","time":"22:15"},{"path":"\\/catalog","time":"22:15"},{"path":"\\/order\\/cpanel","time":"22:15"},{"path":"\\/","time":"22:15"},{"path":"\\/domain-registration","time":"22:18"},{"path":"\\/cart","time":"22:18"},{"path":"\\/notifications","time":"22:19"},{"path":"\\/","time":"22:19"},{"path":"\\/services","time":"22:20"}]	2026-08-14 14:08:05	2026-08-14 22:20:15
1151	j1AwpElBQHKY7WwwkIvtAEYqEaYeRtFcVAkWJorb	66.249.68.129	2026-08-22	[{"path":"\\/saas\\/langganan-paket-leadly","time":"11:34"}]	2026-08-22 11:34:20	2026-08-22 11:34:20
1168	UW2EWSauvEciXHmS87mx9VLDCkQz1pbfxmVUWffb	66.249.66.75	2026-08-23	[{"path":"\\/about-us","time":"19:21"}]	2026-08-23 19:21:24	2026-08-23 19:21:24
1185	jODpprDCBihv42D6ufxMsBM6Hot1vjOo0Z0OviUR	103.188.252.173	2026-08-25	[{"path":"\\/","time":"20:52"}]	2026-08-25 20:52:35	2026-08-25 20:52:35
1186	FvyskbHGcjAnM7AgKrGPapEYDJjerSBaLWOwUtcl	182.253.150.4	2026-08-26	[{"path":"\\/","time":"12:14"}]	2026-08-26 12:14:34	2026-08-26 12:14:35
1245	VqyrVESro3Q27FcOFafbCuflZ6vmL66ppWwIsS3T	52.167.144.160	2026-09-01	[{"path":"\\/domain-registration","time":"18:10"}]	2026-09-01 18:10:46	2026-09-01 18:10:46
1259	kF4KvygDx7TXsNelvACwuVmsVvkuuG3obQXccEZl	66.249.79.37	2026-09-03	[{"path":"\\/","time":"01:14"}]	2026-09-03 01:14:01	2026-09-03 01:14:01
1272	qsKSwpPwW1Kn7tnPLG0Cv3dFftupMykbvBdz8eJZ	114.10.16.173	2026-09-04	[{"path":"\\/","time":"08:01"}]	2026-09-04 08:01:06	2026-09-04 08:01:06
1286	X3QFUbGberRddESZQDxXOM5tjbyGXkfG5Sph57YC	182.2.164.243	2026-09-06	[{"path":"\\/about-us","time":"16:43"}]	2026-09-06 16:43:10	2026-09-06 16:43:10
1152	pTue5qafKR86C0TwEd6tmKdm23M5WOkzmtJOpDzw	66.249.71.96	2026-08-22	[{"path":"\\/order\\/vps","time":"12:31"}]	2026-08-22 12:31:33	2026-08-22 12:31:33
1169	c4v5yXlPUHoVqSY5css3HoWRGupFQbL0kExj1WA5	114.10.120.61	2026-08-23	[{"path":"\\/","time":"21:25"},{"path":"\\/services","time":"21:25"},{"path":"\\/","time":"21:25"},{"path":"\\/saas-marketplace","time":"21:25"},{"path":"\\/saas\\/chatbot-plugin","time":"21:26"}]	2026-08-23 21:25:29	2026-08-23 21:26:11
1187	ntWNfcDmsxOWtqkgyv0otiMRlt0BV76VMKO9RsQw	125.161.74.68	2026-08-26	[{"path":"\\/","time":"12:15"}]	2026-08-26 12:15:41	2026-08-26 12:15:41
1203	jJkLN4MOps5KzNYvkFLjlINR7xyz5RqJgz8kvTVb	104.238.129.239	2026-08-28	[{"path":"\\/","time":"14:34"}]	2026-08-28 14:34:38	2026-08-28 14:34:38
1218	6d40FrmfKnkytDxqgwrN8rrvaAMfe94f5KDxdhsK	112.78.177.4	2026-08-30	[{"path":"\\/catalog","time":"20:08"}]	2026-08-30 20:08:57	2026-08-30 20:08:57
1232	5akNf2sjUZnrnM945vFWgJLpBWn6xx7yFaVgF8RA	103.147.8.141	2026-08-31	[{"path":"\\/","time":"20:54"},{"path":"\\/client-area","time":"20:54"},{"path":"\\/client-area\\/hosting","time":"20:54"},{"path":"\\/client-area\\/vps","time":"20:54"},{"path":"\\/client-area\\/plugin","time":"20:54"},{"path":"\\/client-area\\/plugin\\/manage","time":"20:57"}]	2026-08-31 20:54:03	2026-08-31 20:57:02
1246	kSHdiEmJr1Orq2YLugjwVm2BrdtXNOiMkw3qUolV	140.213.24.100	2026-09-01	[{"path":"\\/","time":"19:01"},{"path":"\\/login","time":"19:01"}]	2026-09-01 19:01:33	2026-09-01 19:01:36
1260	LL2VjiCRcjvRftc2YbVQ5Y1CmNNZGoe4nevweNDK	66.249.79.37	2026-09-03	[{"path":"\\/","time":"01:14"}]	2026-09-03 01:14:42	2026-09-03 01:14:42
1273	e7fnw9teUqtUEFSQLGoguadPdSlnB20enOrrrhZk	66.249.71.171	2026-09-04	[{"path":"\\/","time":"09:06"}]	2026-09-04 09:06:44	2026-09-04 09:06:44
1287	b5TKlWEmHC6cmN1tZFhp9tKxHskeirVyz8nVLSGC	66.249.66.70	2026-09-06	[{"path":"\\/login","time":"16:52"}]	2026-09-06 16:52:46	2026-09-06 16:52:46
1129	NpqzuulLRVO9BFWNillvCu7iCZMWUhiZCnriR3i1	66.249.71.98	2026-08-20	[{"path":"\\/services","time":"05:52"}]	2026-08-20 05:52:53	2026-08-20 05:52:54
1105	YM77svAcSPLxwtj679LKIPvgruwnlef6k4w8rZUk	82.158.131.175	2026-08-14	[{"path":"\\/admin\\/dashboard","time":"20:09"},{"path":"\\/admin\\/tickets","time":"20:09"},{"path":"\\/admin\\/hero","time":"20:09"},{"path":"\\/admin\\/saas-management","time":"20:11"},{"path":"\\/admin\\/portfolios","time":"20:22"},{"path":"\\/admin\\/portfolios\\/create","time":"20:23"},{"path":"\\/admin\\/portfolios","time":"20:29"},{"path":"\\/admin\\/portfolios\\/1\\/edit","time":"20:29"},{"path":"\\/admin\\/portfolios","time":"20:30"},{"path":"\\/admin\\/portfolios\\/1\\/edit","time":"20:30"},{"path":"\\/admin\\/portfolios","time":"20:30"},{"path":"\\/admin\\/portfolios\\/2\\/edit","time":"20:31"},{"path":"\\/admin\\/portfolios","time":"20:31"},{"path":"\\/admin\\/portfolios\\/3\\/edit","time":"20:32"},{"path":"\\/admin\\/portfolios","time":"20:33"},{"path":"\\/admin\\/portfolios\\/4\\/edit","time":"20:33"},{"path":"\\/admin\\/portfolios","time":"20:34"},{"path":"\\/admin\\/portfolios\\/5\\/edit","time":"20:34"},{"path":"\\/admin\\/portfolios","time":"20:34"},{"path":"\\/admin\\/portfolios\\/6\\/edit","time":"20:35"},{"path":"\\/admin\\/portfolios","time":"20:35"},{"path":"\\/admin\\/portfolios\\/7\\/edit","time":"20:35"},{"path":"\\/admin\\/portfolios","time":"20:36"},{"path":"\\/admin\\/portfolios\\/8\\/edit","time":"20:36"},{"path":"\\/admin\\/portfolios","time":"20:37"},{"path":"\\/admin\\/portfolios\\/8\\/edit","time":"20:38"},{"path":"\\/admin\\/portfolios","time":"20:38"},{"path":"\\/admin\\/portfolios\\/9\\/edit","time":"20:39"},{"path":"\\/admin\\/portfolios","time":"20:39"},{"path":"\\/admin\\/portfolios\\/10\\/edit","time":"20:40"},{"path":"\\/admin\\/portfolios","time":"20:40"},{"path":"\\/admin\\/portfolios\\/11\\/edit","time":"20:40"},{"path":"\\/admin\\/portfolios","time":"20:41"},{"path":"\\/admin\\/portfolios\\/12\\/edit","time":"20:41"},{"path":"\\/admin\\/portfolios","time":"20:42"},{"path":"\\/admin\\/portfolios\\/13\\/edit","time":"20:42"},{"path":"\\/admin\\/portfolios","time":"20:42"},{"path":"\\/admin\\/portfolios\\/14\\/edit","time":"20:43"},{"path":"\\/admin\\/portfolios","time":"20:43"},{"path":"\\/admin\\/portfolios\\/14\\/edit","time":"20:49"},{"path":"\\/admin\\/portfolios","time":"20:53"},{"path":"\\/admin\\/dashboard","time":"20:57"},{"path":"\\/admin\\/chatbot\\/responses","time":"20:57"},{"path":"\\/admin\\/chatbot\\/history","time":"20:57"},{"path":"\\/admin\\/chatbot\\/responses","time":"20:57"},{"path":"\\/","time":"21:55"},{"path":"\\/domain-registration","time":"22:03"},{"path":"\\/","time":"22:03"},{"path":"\\/vps-hosting","time":"22:03"},{"path":"\\/","time":"22:04"},{"path":"\\/catalog","time":"22:05"},{"path":"\\/order\\/cpanel","time":"22:05"},{"path":"\\/","time":"22:08"},{"path":"\\/domain-registration","time":"22:08"},{"path":"\\/","time":"22:09"},{"path":"\\/admin\\/hero","time":"22:16"},{"path":"\\/admin\\/tickets","time":"22:16"}]	2026-08-14 20:09:34	2026-08-14 22:16:48
1107	pskaI9Y0f2jIOmZHEbhZgjeGIvP0t87O26HEqc5y	82.158.131.175	2026-08-14	[{"path":"\\/order\\/vps","time":"21:28"},{"path":"\\/notifications","time":"21:29"},{"path":"\\/cart","time":"21:29"},{"path":"\\/","time":"21:29"},{"path":"\\/portfolio","time":"21:29"}]	2026-08-14 21:28:46	2026-08-14 21:29:32
1109	fe2EwmP36xK4GKEJlRAvSNaMZ1NYVA0vNTRcASef	182.253.150.1	2026-08-15	[{"path":"\\/","time":"02:31"}]	2026-08-15 02:31:44	2026-08-15 02:31:44
1108	EonFDhYcrWYMBrlrwXhJvJlJEbdS7QZ1rZqxA6oA	159.195.111.201	2026-08-14	[{"path":"\\/","time":"22:00"}]	2026-08-14 22:00:35	2026-08-14 22:00:35
1110	Qz17Pxe3FFgAhm382RlFosIDkQnjVNFMZWrd6w2x	40.77.177.106	2026-08-15	[{"path":"\\/domain-registration","time":"17:01"}]	2026-08-15 17:01:32	2026-08-15 17:01:33
1111	Gv9pYMWDiaF6HnWM2aitIvfowAwIcSJW0XHxdiGf	17.22.253.195	2026-08-16	[{"path":"\\/domain-registration","time":"08:28"}]	2026-08-16 08:28:38	2026-08-16 08:28:38
1112	yLSvf23P5MxA68MJqc0dtC9uJHinaGoT2V4fEMoh	40.77.167.44	2026-08-16	[{"path":"\\/about-us","time":"18:20"}]	2026-08-16 18:20:18	2026-08-16 18:20:18
1106	JwrbR8mxq0f3swAhe5iZCxW736IhCI5yQ1DpsAPZ	82.158.131.175	2026-08-14	[{"path":"\\/","time":"21:06"},{"path":"\\/catalog","time":"21:07"},{"path":"\\/domain-registration","time":"21:08"},{"path":"\\/","time":"21:26"},{"path":"\\/order\\/cpanel","time":"21:26"},{"path":"\\/order\\/vps","time":"21:27"},{"path":"\\/login","time":"21:28"}]	2026-08-14 21:06:49	2026-08-14 21:28:18
1113	36wNsnXd1RSMK9W87Wh8Abwa38gen4ERPU4s4X67	66.249.71.128	2026-08-16	[{"path":"\\/login","time":"18:29"}]	2026-08-16 18:29:16	2026-08-16 18:29:16
1130	mcbJorZ2n1m4I10DauFYpqzuENQPAZ1FkcuiMhtN	40.77.167.46	2026-08-20	[{"path":"\\/login","time":"10:43"}]	2026-08-20 10:43:03	2026-08-20 10:43:03
1114	XkAzYfCrDpSnogFoWULVPd833dKx54FKXIpiycjV	103.147.8.19	2026-08-17	[{"path":"\\/","time":"18:52"}]	2026-08-17 18:52:47	2026-08-17 18:52:48
1115	xJrM1AQtzGiYsSWqWQjR0jz1bLSr6gu1f2npeVFR	103.147.8.19	2026-08-17	[{"path":"\\/","time":"20:03"}]	2026-08-17 20:03:09	2026-08-17 20:03:09
1116	m4bjZtxOdeQpoWY8IKNBM4pd5OMtm6yzo1Uee6bD	34.32.180.166	2026-08-17	[{"path":"\\/","time":"20:15"}]	2026-08-17 20:15:02	2026-08-17 20:15:02
1117	L44NZBYS0TOo42u5N5QmkB713hGXsQq4Ltc0FGDy	23.27.145.129	2026-08-17	[{"path":"\\/","time":"20:57"}]	2026-08-17 20:57:48	2026-08-17 20:57:48
1118	owkM3I4gVpvdKkAUpIRj85ragyH02w3pVLnY6CLi	66.249.66.75	2026-08-18	[{"path":"\\/about-us","time":"15:23"}]	2026-08-18 15:23:53	2026-08-18 15:23:53
1119	gveHsZaVw6WEj0pCgtc76T9PIBijCIaSZvnlBxxU	66.249.66.97	2026-08-18	[{"path":"\\/","time":"22:29"}]	2026-08-18 22:29:09	2026-08-18 22:29:09
1120	irCshpGnqC2ksx0ht6PWCWjHD1XdXXczX1bhbWrc	66.249.71.98	2026-08-18	[{"path":"\\/faq","time":"23:03"}]	2026-08-18 23:03:06	2026-08-18 23:03:06
1121	3lrUTR6w1SQx0muzdNk7Y6yQYYWkKfpz7lnoNVyB	66.249.71.98	2026-08-18	[{"path":"\\/cpanel-hosting","time":"23:28"}]	2026-08-18 23:28:43	2026-08-18 23:28:43
1122	ZiRleDrhZ96IY5eIqOb5XGWy6L5l5OiLLnB5ZhQ6	125.160.234.163	2026-08-19	[{"path":"\\/","time":"10:02"},{"path":"\\/about-us","time":"10:03"},{"path":"\\/","time":"10:03"},{"path":"\\/services","time":"10:03"},{"path":"\\/portfolio","time":"10:04"},{"path":"\\/","time":"10:16"},{"path":"\\/contact","time":"10:17"}]	2026-08-19 10:02:32	2026-08-19 10:17:28
1123	KFYaHvTKblo4Ot6j5b2Iwkdy5NDnupA9Zgk5F5uk	40.77.178.213	2026-08-19	[{"path":"\\/","time":"10:37"}]	2026-08-19 10:37:39	2026-08-19 10:37:39
1124	lveNPwpsJSTc0Dqs4ZeCzHbzAUnh2BMPB75zHeJ9	69.63.184.53	2026-08-19	[{"path":"\\/","time":"11:04"}]	2026-08-19 11:04:06	2026-08-19 11:04:06
1131	twHP1PIWmgncGdXKFlypNE4vWrkRtPpssDeKUnVB	173.252.87.15	2026-08-20	[{"path":"\\/","time":"11:04"}]	2026-08-20 11:04:26	2026-08-20 11:04:26
1132	m0jdvs6euCDs56wXchAgK04xckk6LGF0unRCyGmo	160.202.36.68	2026-08-20	[{"path":"\\/","time":"11:37"}]	2026-08-20 11:37:41	2026-08-20 11:37:41
1125	24fabRHWzAxyDg0lvpyUDQgxP22NDpW3jheEwyg7	156.230.182.65	2026-08-19	[{"path":"\\/","time":"11:19"},{"path":"\\/catalog","time":"11:19"},{"path":"\\/saas-marketplace","time":"11:20"},{"path":"\\/saas\\/langganan-paket-leadly","time":"11:20"}]	2026-08-19 11:19:20	2026-08-19 11:20:39
1126	0koHAARfIWymyfrFlNt45lg0MwambpfAkrDLihmF	173.252.95.56	2026-08-19	[{"path":"\\/","time":"21:36"}]	2026-08-19 21:36:57	2026-08-19 21:36:57
1127	i3LxlDvFRVQ7TRVLjOryJM2TVfK1f20U7AYdULDV	66.249.66.204	2026-08-20	[{"path":"\\/order\\/saas","time":"05:40"}]	2026-08-20 05:40:40	2026-08-20 05:40:40
1128	ZeadYcn2WBc3LESk2ZwLami1xiEBbso6YIZjf8lg	66.249.66.204	2026-08-20	[{"path":"\\/order\\/vps","time":"05:46"}]	2026-08-20 05:46:43	2026-08-20 05:46:43
1133	wLO5fxgGEi45ufeK35YA40XSf9x31I5nYxZY8ZT8	52.167.144.220	2026-08-20	[{"path":"\\/vps-hosting","time":"11:49"}]	2026-08-20 11:49:10	2026-08-20 11:49:10
1134	wwLMnZLiPdhlwf4HOhkwHXTTQF6zvjviaPSsoHYD	66.249.68.129	2026-08-20	[{"path":"\\/order\\/cpanel","time":"13:13"}]	2026-08-20 13:13:21	2026-08-20 13:13:21
1135	VWk31fBZJeBMZd0U8GkrfHCgARJfvoQCphBNOOa6	173.252.87.55	2026-08-20	[{"path":"\\/","time":"14:37"}]	2026-08-20 14:37:54	2026-08-20 14:37:54
1136	9JqaR2WeT41nrbEhKfDVfsWufCYIJ10roEOccwlt	173.252.87.16	2026-08-20	[{"path":"\\/","time":"17:22"}]	2026-08-20 17:22:53	2026-08-20 17:22:53
1137	gakCC2l8KKjJnoPbOxd5OuF2B61576sdIoGRhTVN	66.249.66.202	2026-08-20	[{"path":"\\/","time":"18:32"}]	2026-08-20 18:32:25	2026-08-20 18:32:25
1138	mpuUhA1C8zDqmbGNYZZ9hnO6exhKJZi9Xgc7dggB	66.249.66.32	2026-08-20	[{"path":"\\/","time":"18:32"}]	2026-08-20 18:32:27	2026-08-20 18:32:27
1139	AeW317nMkF0gTXrru6abmhPh6L0PG5cRwcqPhzaq	66.249.71.96	2026-08-21	[{"path":"\\/portfolio","time":"03:59"}]	2026-08-21 03:59:57	2026-08-21 03:59:57
1140	qK5M6Xi1adX3FQOqOFUboHL9ziGoaZFnS49TLJOI	66.249.66.202	2026-08-21	[{"path":"\\/register","time":"04:42"}]	2026-08-21 04:42:54	2026-08-21 04:42:54
1141	zL1bTvgwaXVkzIZy3zR5yBjYXEqXsP4ElouunFp9	114.10.20.147	2026-08-21	[{"path":"\\/","time":"05:30"}]	2026-08-21 05:30:03	2026-08-21 05:30:03
1142	Ep9rGj8BZPLKu1DuwQQoZhLV5KUoraF0vgkxmcQh	182.8.229.23	2026-08-21	[{"path":"\\/","time":"05:38"}]	2026-08-21 05:38:25	2026-08-21 05:38:25
1143	7W86eyiNWXQt4RXTIrrcSe3OEop9z5wjoL69guQn	66.249.71.96	2026-08-21	[{"path":"\\/register","time":"16:03"}]	2026-08-21 16:03:58	2026-08-21 16:03:58
1144	swVMH24lFtrYl7vMCMtCPkLKUjvHCn4NLhepx9Fm	66.249.68.129	2026-08-22	[{"path":"\\/","time":"01:10"}]	2026-08-22 01:10:19	2026-08-22 01:10:19
1145	EgbtTp6ej4Qvbm432Vs79DyAOPyGqSkt6RK8O70F	66.249.71.96	2026-08-22	[{"path":"\\/register","time":"06:13"}]	2026-08-22 06:13:23	2026-08-22 06:13:23
1146	xw7Hs8XT5PXvHzVk2ErGxjse5jUOxmL4ssYAHDL2	66.249.68.128	2026-08-22	[{"path":"\\/saas-marketplace","time":"09:03"}]	2026-08-22 09:03:10	2026-08-22 09:03:10
1147	OaeVq7sXIZjTeImEMFvgpMmRZAvd3Ck6RpxyMuWh	66.249.68.128	2026-08-22	[{"path":"\\/contact","time":"10:18"}]	2026-08-22 10:18:09	2026-08-22 10:18:09
1148	YX9RilLU1JHUAFaUbhQ6sD01Fx9LjaRNoS4tIQBv	66.249.66.202	2026-08-22	[{"path":"\\/","time":"11:03"}]	2026-08-22 11:03:43	2026-08-22 11:03:43
\.


--
-- Name: admins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admins_id_seq', 2, true);


--
-- Name: carts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.carts_id_seq', 66, true);


--
-- Name: chat_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chat_messages_id_seq', 94, true);


--
-- Name: chat_sessions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chat_sessions_id_seq', 638, true);


--
-- Name: chatbot_knowledges_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chatbot_knowledges_id_seq', 10, true);


--
-- Name: chatbot_leads_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chatbot_leads_id_seq', 28, true);


--
-- Name: chatbot_responses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chatbot_responses_id_seq', 12, true);


--
-- Name: email_accounts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.email_accounts_id_seq', 3, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: helpdesk_users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.helpdesk_users_id_seq', 6, true);


--
-- Name: hero_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.hero_settings_id_seq', 1, true);


--
-- Name: invoices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.invoices_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 44, true);


--
-- Name: order_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.order_items_id_seq', 63, true);


--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orders_id_seq', 52, true);


--
-- Name: portfolios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.portfolios_id_seq', 14, true);


--
-- Name: product_features_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_features_id_seq', 1083, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 1168, true);


--
-- Name: saas_products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.saas_products_id_seq', 10, true);


--
-- Name: saas_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.saas_reviews_id_seq', 1, true);


--
-- Name: subscriptions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.subscriptions_id_seq', 1, false);


--
-- Name: ticket_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.ticket_messages_id_seq', 1, false);


--
-- Name: tickets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tickets_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 23, true);


--
-- Name: visitor_logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visitor_logs_id_seq', 1291, true);


--
-- Name: admins admins_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_pkey PRIMARY KEY (id);


--
-- Name: admins admins_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_username_unique UNIQUE (username);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: carts carts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_pkey PRIMARY KEY (id);


--
-- Name: chat_messages chat_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat_messages
    ADD CONSTRAINT chat_messages_pkey PRIMARY KEY (id);


--
-- Name: chat_sessions chat_sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat_sessions
    ADD CONSTRAINT chat_sessions_pkey PRIMARY KEY (id);


--
-- Name: chat_sessions chat_sessions_session_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat_sessions
    ADD CONSTRAINT chat_sessions_session_id_unique UNIQUE (session_id);


--
-- Name: chatbot_knowledges chatbot_knowledges_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_knowledges
    ADD CONSTRAINT chatbot_knowledges_pkey PRIMARY KEY (id);


--
-- Name: chatbot_leads chatbot_leads_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_leads
    ADD CONSTRAINT chatbot_leads_pkey PRIMARY KEY (id);


--
-- Name: chatbot_responses chatbot_responses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_responses
    ADD CONSTRAINT chatbot_responses_pkey PRIMARY KEY (id);


--
-- Name: email_accounts email_accounts_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.email_accounts
    ADD CONSTRAINT email_accounts_email_unique UNIQUE (email);


--
-- Name: email_accounts email_accounts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.email_accounts
    ADD CONSTRAINT email_accounts_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: helpdesk_users helpdesk_users_license_key_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.helpdesk_users
    ADD CONSTRAINT helpdesk_users_license_key_email_unique UNIQUE (license_key, email);


--
-- Name: helpdesk_users helpdesk_users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.helpdesk_users
    ADD CONSTRAINT helpdesk_users_pkey PRIMARY KEY (id);


--
-- Name: hero_settings hero_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.hero_settings
    ADD CONSTRAINT hero_settings_pkey PRIMARY KEY (id);


--
-- Name: invoices invoices_invoice_no_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.invoices
    ADD CONSTRAINT invoices_invoice_no_unique UNIQUE (invoice_no);


--
-- Name: invoices invoices_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.invoices
    ADD CONSTRAINT invoices_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: notifications notifications_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notifications
    ADD CONSTRAINT notifications_pkey PRIMARY KEY (id);


--
-- Name: order_items order_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_pkey PRIMARY KEY (id);


--
-- Name: orders orders_invoice_number_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_invoice_number_unique UNIQUE (invoice_number);


--
-- Name: orders orders_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: portfolios portfolios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.portfolios
    ADD CONSTRAINT portfolios_pkey PRIMARY KEY (id);


--
-- Name: portfolios portfolios_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.portfolios
    ADD CONSTRAINT portfolios_slug_unique UNIQUE (slug);


--
-- Name: product_features product_features_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_features
    ADD CONSTRAINT product_features_pkey PRIMARY KEY (id);


--
-- Name: products products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);


--
-- Name: products products_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_slug_unique UNIQUE (slug);


--
-- Name: saas_products saas_products_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saas_products
    ADD CONSTRAINT saas_products_pkey PRIMARY KEY (id);


--
-- Name: saas_products saas_products_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saas_products
    ADD CONSTRAINT saas_products_slug_unique UNIQUE (slug);


--
-- Name: saas_reviews saas_reviews_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saas_reviews
    ADD CONSTRAINT saas_reviews_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: subscriptions subscriptions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subscriptions
    ADD CONSTRAINT subscriptions_pkey PRIMARY KEY (id);


--
-- Name: ticket_messages ticket_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ticket_messages
    ADD CONSTRAINT ticket_messages_pkey PRIMARY KEY (id);


--
-- Name: tickets tickets_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_godaddy_shopper_id_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_godaddy_shopper_id_unique UNIQUE (godaddy_shopper_id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: visitor_logs visitor_logs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visitor_logs
    ADD CONSTRAINT visitor_logs_pkey PRIMARY KEY (id);


--
-- Name: chat_sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX chat_sessions_user_id_index ON public.chat_sessions USING btree (user_id);


--
-- Name: chatbot_responses_keyword_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX chatbot_responses_keyword_index ON public.chatbot_responses USING btree (keyword);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: notifications_notifiable_type_notifiable_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX notifications_notifiable_type_notifiable_id_index ON public.notifications USING btree (notifiable_type, notifiable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: visitor_logs_date_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX visitor_logs_date_index ON public.visitor_logs USING btree (date);


--
-- Name: visitor_logs_session_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX visitor_logs_session_id_index ON public.visitor_logs USING btree (session_id);


--
-- Name: carts carts_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: chat_messages chat_messages_chat_session_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chat_messages
    ADD CONSTRAINT chat_messages_chat_session_id_foreign FOREIGN KEY (chat_session_id) REFERENCES public.chat_sessions(id) ON DELETE CASCADE;


--
-- Name: chatbot_leads chatbot_leads_admin_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_leads
    ADD CONSTRAINT chatbot_leads_admin_id_foreign FOREIGN KEY (admin_id) REFERENCES public.admins(id) ON DELETE SET NULL;


--
-- Name: chatbot_leads chatbot_leads_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_leads
    ADD CONSTRAINT chatbot_leads_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: helpdesk_users helpdesk_users_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.helpdesk_users
    ADD CONSTRAINT helpdesk_users_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: invoices invoices_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.invoices
    ADD CONSTRAINT invoices_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: order_items order_items_order_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_order_id_foreign FOREIGN KEY (order_id) REFERENCES public.orders(id) ON DELETE CASCADE;


--
-- Name: orders orders_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: product_features product_features_product_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.product_features
    ADD CONSTRAINT product_features_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON DELETE CASCADE;


--
-- Name: saas_products saas_products_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saas_products
    ADD CONSTRAINT saas_products_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: saas_reviews saas_reviews_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.saas_reviews
    ADD CONSTRAINT saas_reviews_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: subscriptions subscriptions_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.subscriptions
    ADD CONSTRAINT subscriptions_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: ticket_messages ticket_messages_admin_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ticket_messages
    ADD CONSTRAINT ticket_messages_admin_id_foreign FOREIGN KEY (admin_id) REFERENCES public.admins(id) ON DELETE SET NULL;


--
-- Name: ticket_messages ticket_messages_ticket_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ticket_messages
    ADD CONSTRAINT ticket_messages_ticket_id_foreign FOREIGN KEY (ticket_id) REFERENCES public.tickets(id) ON DELETE CASCADE;


--
-- Name: ticket_messages ticket_messages_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.ticket_messages
    ADD CONSTRAINT ticket_messages_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: tickets tickets_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tickets
    ADD CONSTRAINT tickets_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict l1yKO2BAsbJ29JP3F76siQbsgLUsgoo2PaQQzexUFVTzD7ubpt3jG4dJDMhFI3b

