--
-- PostgreSQL database dump
--

\restrict glcUoaVwfP8AN0QtMpZ5vfgB5g7cIhiaqa8krpfo8TKh2YTICSWYhaACVs0ccEg

-- Dumped from database version 15.15
-- Dumped by pg_dump version 15.15

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
    CONSTRAINT chat_messages_sender_check CHECK (((sender)::text = ANY ((ARRAY['user'::character varying, 'bot'::character varying])::text[])))
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
-- Name: hero_settings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.hero_settings (
    id bigint NOT NULL,
    tagline character varying(255),
    title character varying(255),
    subtitle text,
    background_images json,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
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
    CONSTRAINT invoices_status_check CHECK (((status)::text = ANY ((ARRAY['Paid'::character varying, 'Unpaid'::character varying, 'Cancelled'::character varying])::text[])))
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
    updated_at timestamp(0) without time zone
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
    CONSTRAINT saas_products_status_check CHECK (((status)::text = ANY ((ARRAY['pending'::character varying, 'approved'::character varying, 'rejected'::character varying])::text[])))
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
-- Name: chatbot_responses id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_responses ALTER COLUMN id SET DEFAULT nextval('public.chatbot_responses_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


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
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: admins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.admins (id, name, username, password, role, remember_token, created_at, updated_at) FROM stdin;
1	Super Admin	admin	$2y$12$4o10sZYbH3mRijuz/gO0ve7wo1zTaBrbIZfjOC3FrhvBhnxNDRqS.	admin	\N	2025-12-04 15:30:49	2025-12-04 15:30:49
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
5	1	vps	VPS Starter	182500.00	monthly	"{\\"os\\":\\"almalinux\\"}"	2026-02-07 04:24:11	2026-02-07 04:24:11
6	1	saas	SSL Certificates - PositiveSSL Multi-Domain	354000.00	annually	"{\\"domain_connection\\":null}"	2026-02-07 04:26:33	2026-02-07 04:26:33
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
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: hero_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.hero_settings (id, tagline, title, subtitle, background_images, created_at, updated_at) FROM stdin;
1	\N	\N	\N	["assets\\/bg.jpg","hero\\/kyJJF31sWC6vxxnNMPGthurhxPUM5EFbKbUXvOPS.png"]	2025-12-09 11:18:33	2025-12-09 11:18:45
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
5	4	apaaja.org	domain	236000.00	1 Year(s)	"{\\"years\\":\\"1\\"}"	2025-12-17 13:16:30	2025-12-17 13:16:30
6	5	namabisnis.net	domain	254000.00	1 Year(s)	"{\\"years\\":\\"1\\"}"	2025-12-17 13:53:06	2025-12-17 13:53:06
7	6	askjhdasds.com	domain	254000.00	1 Year(s)	"{\\"years\\":\\"1\\",\\"action\\":\\"register\\"}"	2025-12-19 03:53:07	2025-12-19 03:53:07
\.


--
-- Data for Name: orders; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.orders (id, user_id, invoice_number, total_amount, payment_method, status, paid_at, created_at, updated_at) FROM stdin;
1	9	INV-MIG-UPWFJZ	3300000.00	bank_transfer	paid	2025-12-12 13:03:43	2025-12-12 13:03:43	2025-12-17 13:03:43
2	10	INV-MIG-2GRTTU	1500000.00	bank_transfer	paid	2025-12-15 13:03:43	2025-12-15 13:03:43	2025-12-17 13:03:43
3	15	INV-MIG-3PBDLP	1500000.00	bank_transfer	paid	2025-12-15 13:03:44	2025-12-15 13:03:44	2025-12-17 13:03:44
4	1	INV-20251217-PXKEK	261960.00	bank_bni	pending	\N	2025-12-17 13:16:30	2025-12-17 13:16:30
5	1	INV-20251217-RGYGH	281940.00	bank_bni	pending	\N	2025-12-17 13:53:06	2025-12-17 13:53:06
6	1	INV-20251219-BGWGL	281940.00	bank_bni	pending	\N	2025-12-19 03:53:07	2025-12-19 03:53:07
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: portfolios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.portfolios (id, title, slug, category, client, url, description, image, created_at, updated_at) FROM stdin;
1	E-Commerce Fashion Muslim	e-commerce-fashion-muslim	Web Development	\N	https://tokocontoh.id	Platform toko online berkinerja tinggi dengan integrasi payment gateway midtrans dan sistem manajemen stok real-time.	portfolios/sample-1.jpg	2025-12-19 12:38:05	2025-12-19 12:38:05
2	Sistem Informasi Rumah Sakit	sistem-informasi-rumah-sakit	SaaS Application	\N	https://rs-smart.id	Aplikasi manajemen pasien dan rekam medis elektronik berbasis cloud yang aman dan compliant dengan regulasi kesehatan.	portfolios/sample-2.jpg	2025-12-19 12:38:05	2025-12-19 12:38:05
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
12	.1	domain-1	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	738000.00	738000.00	Numeric	\N
13	.1D	domain-1d	domain	553500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	424000.00	424000.00	Numeric	\N
14	.1Q	domain-1q	domain	572000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	572000.00	572000.00	Numeric	\N
15	.247	domain-247	domain	3653000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	3653000.00	3653000.00	Numeric	\N
16	.35	domain-35	domain	553500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Numeric	\N
17	.3DOM	domain-3dom	domain	350500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	Numeric	\N
18	.49	domain-49	domain	1383500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1365000.00	1365000.00	Numeric	\N
19	.4FREE	domain-4free	domain	572000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	572000.00	572000.00	Numeric	\N
20	.4K	domain-4k	domain	1236000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1236000.00	1236000.00	Numeric	\N
21	.AC	domain-ac	domain	664000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	738000.00	664000.00	Education	\N
22	.ACADEMY	domain-academy	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Education	\N
23	.ACCOUNTANT	domain-accountant	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	Finance	\N
24	.ACCOUNTANTS	domain-accountants	domain	1291000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1476000.00	1476000.00	International	\N
25	.ACTOR	domain-actor	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	627000.00	627000.00	International	\N
26	.AD	domain-ad	domain	2379500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	3080500.00	2379500.00	International	\N
27	.ADDME	domain-addme	domain	138000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	138000.00	138000.00	International	\N
28	.ADULT	domain-adult	domain	1180500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1328000.00	1328000.00	International	\N
29	.AERO	domain-aero	domain	2029000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2629000.00	2029000.00	International	\N
30	.AE.ORG	domain-aeorg	domain	424000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	442500.00	442500.00	International	\N
31	.AF	domain-af	domain	940500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	940500.00	940500.00	International	\N
32	.AFRICA	domain-africa	domain	166000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	424000.00	424000.00	International	\N
33	.AGENCY	domain-agency	domain	92000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	313500.00	313500.00	Business	\N
34	.AGS	domain-ags	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	738000.00	738000.00	International	\N
35	.AHOY	domain-ahoy	domain	138000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	424000.00	138000.00	International	\N
36	.AI	domain-ai	domain	1291000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1439000.00	1291000.00	Popular	\N
37	.AIRFORCE	domain-airforce	domain	2490500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2629000.00	2629000.00	International	\N
38	.ALBUMS	domain-albums	domain	295000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	International	\N
39	.AM	domain-am	domain	1402000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1402000.00	1402000.00	International	\N
40	.AMIGO	domain-amigo	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	International	\N
41	.ANE	domain-ane	domain	1605000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1605000.00	1605000.00	International	\N
42	.AO	domain-ao	domain	5813500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	5813500.00	5813500.00	International	\N
43	.APARTMENTS	domain-apartments	domain	1125000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1346500.00	1346500.00	Real Estate	\N
44	.APP	domain-app	domain	221500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	258000.00	258000.00	Tech	\N
45	.ARCHI	domain-archi	domain	1033000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1180500.00	1180500.00	International	\N
46	.ARMY	domain-army	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
47	.ART	domain-art	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	276500.00	276500.00	Media	\N
48	.ARTE	domain-arte	domain	276500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	350500.00	276500.00	International	\N
49	.ARTICLES	domain-articles	domain	295000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	International	\N
50	.ARTIFICIAL	domain-artificial	domain	8283000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	8283000.00	8283000.00	International	\N
51	.ASIA	domain-asia	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	258000.00	258000.00	Location	\N
52	.ASSOCIATES	domain-associates	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
53	.AT	domain-at	domain	258000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	276500.00	258000.00	International	\N
54	.ATH	domain-ath	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	922500.00	369000.00	International	\N
55	.ATM	domain-atm	domain	848500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1420500.00	848500.00	International	\N
56	.AUCTION	domain-auction	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
57	.AUDIO	domain-audio	domain	1476000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1752500.00	1752500.00	Media	\N
58	.AUTO	domain-auto	domain	36900000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	36900000.00	36900000.00	International	\N
59	.AUTOS	domain-autos	domain	42000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	54500.00	42000.00	International	\N
60	.AW	domain-aw	domain	756500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	756500.00	756500.00	International	\N
61	.BABY	domain-baby	domain	922500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1070000.00	1070000.00	International	\N
62	.BA.IT	domain-bait	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	International	\N
63	.BAND	domain-band	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	442500.00	442500.00	International	\N
64	.BANK	domain-bank	domain	14734000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	16228500.00	16228500.00	Finance	\N
65	.BAR	domain-bar	domain	922500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1217500.00	1217500.00	International	\N
66	.BARGAINS	domain-bargains	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
67	.BEAUTY	domain-beauty	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	Lifestyle	\N
68	.BEER	domain-beer	domain	406000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	461000.00	461000.00	International	\N
69	.BERLIN	domain-berlin	domain	1291000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1328000.00	1291000.00	Location	\N
70	.BEST	domain-best	domain	40000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1660000.00	1660000.00	International	\N
71	.BET	domain-bet	domain	498000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	498000.00	International	\N
72	.BID	domain-bid	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	516500.00	516500.00	International	\N
73	.BIKE	domain-bike	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
74	.BINGO	domain-bingo	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	International	\N
75	.BIO	domain-bio	domain	1014500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1180500.00	1180500.00	International	\N
76	.BIOMETRIC	domain-biometric	domain	1642000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1642000.00	1642000.00	International	\N
77	.BIZ	domain-biz	domain	73000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	276500.00	276500.00	Popular	\N
78	.BLACK	domain-black	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	International	\N
79	.BLACKFRIDAY	domain-blackfriday	domain	2029000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2379500.00	2379500.00	International	\N
80	.BLOG	domain-blog	domain	92000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	424000.00	424000.00	Media	\N
81	.BLUE	domain-blue	domain	258000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	313500.00	313500.00	International	\N
82	.BOATS	domain-boats	domain	1033000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1070000.00	1070000.00	International	\N
83	.BOND	domain-bond	domain	295000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	348500.00	348500.00	International	\N
84	.BOOK	domain-book	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	516500.00	516500.00	International	\N
85	.BOSTON	domain-boston	domain	406000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	479500.00	479500.00	International	\N
86	.BOT	domain-bot	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1199000.00	1199000.00	International	\N
87	.BOUTIQUE	domain-boutique	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
88	.BOX	domain-box	domain	516500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	516500.00	516500.00	International	\N
89	.BR.COM	domain-brcom	domain	756500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	756500.00	International	\N
90	.BRAND	domain-brand	domain	553500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1107000.00	1107000.00	International	\N
91	.BROADWAY	domain-broadway	domain	1051500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1051500.00	1051500.00	International	\N
92	.BROKER	domain-broker	domain	645500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	811500.00	645500.00	International	\N
93	.BROWSERS	domain-browsers	domain	184500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	184500.00	184500.00	International	\N
94	.BUILD	domain-build	domain	996000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1254000.00	1254000.00	International	\N
95	.BUILDERS	domain-builders	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
96	.BUSINESS	domain-business	domain	184500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	276500.00	276500.00	Business	\N
97	.BUY	domain-buy	domain	239500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	239500.00	239500.00	Commerce	\N
98	.BUZZ	domain-buzz	domain	516500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	590000.00	590000.00	International	\N
99	.BZ	domain-bz	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	535000.00	442500.00	International	\N
100	.CA	domain-ca	domain	239500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	276500.00	239500.00	International	\N
101	.CAB	domain-cab	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
102	.CAFE	domain-cafe	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
103	.CAMERA	domain-camera	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
104	.CAMP	domain-camp	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
105	.CAPITAL	domain-capital	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	Finance	\N
106	.CAR	domain-car	domain	36900000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	36900000.00	36900000.00	International	\N
107	.CARDS	domain-cards	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
108	.CARE	domain-care	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Lifestyle	\N
109	.CAREERS	domain-careers	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
110	.CARS	domain-cars	domain	36900000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	36900000.00	36900000.00	International	\N
111	.CASA	domain-casa	domain	203000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	258000.00	258000.00	International	\N
112	.CASH	domain-cash	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Finance	\N
113	.CASINO	domain-casino	domain	1937000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2213500.00	2213500.00	International	\N
114	.CATERING	domain-catering	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
115	.CENTER	domain-center	domain	92000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	International	\N
116	.CEO	domain-ceo	domain	1199000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1365000.00	1365000.00	International	\N
117	.CFD	domain-cfd	domain	92000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
118	.CH	domain-ch	domain	155500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	258000.00	155500.00	International	\N
119	.CHARITY	domain-charity	domain	516500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	701000.00	701000.00	International	\N
120	.CHAT	domain-chat	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
121	.CHEAP	domain-cheap	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Commerce	\N
122	.CHURCH	domain-church	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
123	.CITY	domain-city	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	Location	\N
124	.CLAIMS	domain-claims	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	International	\N
125	.CLEANING	domain-cleaning	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	International	\N
126	.CLICK	domain-click	domain	111000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	203000.00	203000.00	Tech	\N
127	.CLINIC	domain-clinic	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
128	.CLOTHING	domain-clothing	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Commerce	\N
129	.CLOUD	domain-cloud	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	Tech	\N
130	.CLUB	domain-club	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	203000.00	203000.00	Lifestyle	\N
131	.CM	domain-cm	domain	295000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	387500.00	295000.00	International	\N
132	.CN	domain-cn	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	140500.00	442500.00	Location	\N
133	.CO	domain-co	domain	406000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	479500.00	406000.00	Popular	\N
134	.COACH	domain-coach	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
135	.CODES	domain-codes	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
136	.COFFEE	domain-coffee	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
137	.COLLEGE	domain-college	domain	922500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1051500.00	1051500.00	Education	\N
138	.COLOGNE	domain-cologne	domain	350500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	350500.00	International	\N
140	.COM.AU	domain-comau	domain	221500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	221500.00	221500.00	International	\N
141	.COM.CN	domain-comcn	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	140500.00	442500.00	International	\N
142	.COM.CO	domain-comco	domain	110500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	147500.00	110500.00	International	\N
143	.COM.DE	domain-comde	domain	73500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	92000.00	73500.00	International	\N
144	.COM.MX	domain-commx	domain	406000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	535000.00	406000.00	International	\N
145	.COM.SG	domain-comsg	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	830000.00	830000.00	International	\N
146	.COMMUNITY	domain-community	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
147	.COMPANY	domain-company	domain	92000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	313500.00	313500.00	Business	\N
148	.COMPARE	domain-compare	domain	295000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	313500.00	313500.00	International	\N
149	.COMPUTER	domain-computer	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
150	.CONDOS	domain-condos	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	Real Estate	\N
151	.CONSTRUCTION	domain-construction	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Real Estate	\N
152	.CONSULTING	domain-consulting	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Business	\N
153	.CONTACT	domain-contact	domain	295000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	International	\N
154	.CONTRACTORS	domain-contractors	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
155	.COOKING	domain-cooking	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
156	.COOL	domain-cool	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
157	.COOP	domain-coop	domain	2748500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2748500.00	2748500.00	International	\N
158	.COUNTRY	domain-country	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
159	.COUPONS	domain-coupons	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	International	\N
160	.COURSES	domain-courses	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	Education	\N
161	.CPA	domain-cpa	domain	20104000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	20104000.00	20104000.00	International	\N
162	.CREDIT	domain-credit	domain	1291000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1476000.00	1476000.00	Finance	\N
163	.CREDITCARD	domain-creditcard	domain	1771000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	2029000.00	2029000.00	International	\N
164	.CRICKET	domain-cricket	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
165	.CRUISES	domain-cruises	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	International	\N
166	.CRYPTO	domain-crypto	domain	221500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	258000.00	258000.00	International	\N
167	.CX	domain-cx	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	406000.00	369000.00	International	\N
168	.CZ	domain-cz	domain	332000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	332000.00	International	\N
169	.DANCE	domain-dance	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
170	.DATE	domain-date	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Lifestyle	\N
171	.DATING	domain-dating	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	Lifestyle	\N
172	.DAY	domain-day	domain	258000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	313500.00	313500.00	International	\N
173	.DEALS	domain-deals	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Commerce	\N
174	.DEGREE	domain-degree	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
175	.DELIVERY	domain-delivery	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
176	.DEMOCRAT	domain-democrat	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
177	.DENTAL	domain-dental	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
178	.DENTIST	domain-dentist	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
179	.DESIGN	domain-design	domain	590000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	756500.00	756500.00	Media	\N
180	.DEV	domain-dev	domain	184500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	221500.00	221500.00	Tech	\N
181	.DIAMONDS	domain-diamonds	domain	830000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1014500.00	1014500.00	International	\N
182	.DIGITAL	domain-digital	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	516500.00	516500.00	Tech	\N
183	.DIRECT	domain-direct	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
184	.DIRECTORY	domain-directory	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	International	\N
185	.DISCOUNT	domain-discount	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Commerce	\N
186	.DOCTOR	domain-doctor	domain	1291000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1476000.00	1476000.00	International	\N
187	.DOG	domain-dog	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
188	.DOMAINS	domain-domains	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
189	.DOWNLOAD	domain-download	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Tech	\N
190	.EARTH	domain-earth	domain	369000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	461000.00	461000.00	International	\N
191	.ECO	domain-eco	domain	1033000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1180500.00	1180500.00	International	\N
192	.ECONOMICS	domain-economics	domain	350500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	350500.00	350500.00	International	\N
193	.EDUCATION	domain-education	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	Education	\N
194	.EMAIL	domain-email	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	295000.00	295000.00	Tech	\N
195	.ENERGY	domain-energy	domain	1291000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1476000.00	1476000.00	International	\N
196	.ENGINEER	domain-engineer	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
197	.ENGINEERING	domain-engineering	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
198	.ENTERPRISES	domain-enterprises	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Business	\N
199	.EQUIPMENT	domain-equipment	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	International	\N
200	.ESTATE	domain-estate	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Real Estate	\N
201	.EU	domain-eu	domain	129000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	129000.00	129000.00	Location	\N
202	.EVENTS	domain-events	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
203	.EXCHANGE	domain-exchange	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
204	.EXPERT	domain-expert	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
205	.EXPOSED	domain-exposed	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	International	\N
206	.EXPRESS	domain-express	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
207	.FAIL	domain-fail	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
208	.FAITH	domain-faith	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
209	.FAMILY	domain-family	domain	406000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	461000.00	461000.00	Lifestyle	\N
210	.FAN	domain-fan	domain	627000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	719500.00	719500.00	Lifestyle	\N
211	.FANS	domain-fans	domain	922500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1070000.00	1070000.00	Lifestyle	\N
212	.FARM	domain-farm	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
213	.FASHION	domain-fashion	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Commerce	\N
214	.FEEDBACK	domain-feedback	domain	258000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	350500.00	350500.00	International	\N
215	.FILM	domain-film	domain	1439000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1531000.00	1531000.00	Media	\N
216	.FINANCE	domain-finance	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	Finance	\N
217	.FINANCIAL	domain-financial	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	Finance	\N
218	.FISH	domain-fish	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
219	.FISHING	domain-fishing	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
220	.FIT	domain-fit	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Lifestyle	\N
221	.FITNESS	domain-fitness	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	Lifestyle	\N
222	.FLIGHTS	domain-flights	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	Location	\N
223	.FLORIST	domain-florist	domain	479500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	664000.00	664000.00	International	\N
224	.FLOWERS	domain-flowers	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
225	.FM	domain-fm	domain	1439000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	1310000.00	1439000.00	International	\N
226	.FOOTBALL	domain-football	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	International	\N
227	.FORSALE	domain-forsale	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
228	.FOUNDATION	domain-foundation	domain	442500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	553500.00	553500.00	International	\N
229	.FR	domain-fr	domain	166000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	184500.00	166000.00	International	\N
230	.FUN	domain-fun	domain	55500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	424000.00	424000.00	Lifestyle	\N
231	.FUND	domain-fund	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	Finance	\N
232	.FURNITURE	domain-furniture	domain	738000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	848500.00	848500.00	International	\N
233	.FUTBOL	domain-futbol	domain	194000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	239500.00	239500.00	International	\N
234	.FYI	domain-fyi	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	International	\N
235	.GALLERY	domain-gallery	domain	313500.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:07:21	\N	369000.00	369000.00	Media	\N
236	.GAME	domain-game	domain	4425000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	4425000.00	4425000.00	Lifestyle	\N
237	.GAMES	domain-games	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Lifestyle	\N
238	.GARDEN	domain-garden	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
239	.GAY	domain-gay	domain	516500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
240	.GD	domain-gd	domain	701000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	811500.00	701000.00	International	\N
241	.GDN	domain-gdn	domain	221500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	276500.00	276500.00	International	\N
242	.GG	domain-gg	domain	811500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	811500.00	811500.00	International	\N
243	.GIFT	domain-gift	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Commerce	\N
244	.GIFTS	domain-gifts	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
245	.GIVES	domain-gives	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
246	.GLASS	domain-glass	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
247	.GLOBAL	domain-global	domain	516500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	590000.00	590000.00	International	\N
248	.GMBH	domain-gmbh	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	498000.00	498000.00	International	\N
249	.GOLD	domain-gold	domain	1291000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1476000.00	1476000.00	Finance	\N
250	.GOLF	domain-golf	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
251	.GOP	domain-gop	domain	239500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	International	\N
252	.GOSSIP	domain-gossip	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
253	.GOV	domain-gov	domain	295000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	International	\N
254	.GRAPHICS	domain-graphics	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Media	\N
255	.GRATIS	domain-gratis	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
256	.GREEN	domain-green	domain	1033000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1180500.00	1180500.00	International	\N
257	.GRIPE	domain-gripe	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
258	.GROUP	domain-group	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
259	.GUIDE	domain-guide	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
260	.GUITARS	domain-guitars	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
261	.GURU	domain-guru	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	International	\N
262	.HAMBURG	domain-hamburg	domain	1291000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1365000.00	1291000.00	International	\N
263	.HAUS	domain-haus	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
264	.HEALTHCARE	domain-healthcare	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
265	.HELP	domain-help	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
266	.HOCKEY	domain-hockey	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
267	.HOLDINGS	domain-holdings	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
268	.HOLIDAY	domain-holiday	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Location	\N
269	.HOMES	domain-homes	domain	590000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	645500.00	645500.00	International	\N
270	.HORSE	domain-horse	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
271	.HOSPITAL	domain-hospital	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
272	.HOST	domain-host	domain	1291000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1476000.00	1476000.00	Tech	\N
273	.HOSTING	domain-hosting	domain	516500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	590000.00	590000.00	Tech	\N
274	.HOUSE	domain-house	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Real Estate	\N
275	.HOW	domain-how	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	627000.00	627000.00	International	\N
276	.ID	domain-id	domain	221500.00	yr	Best Seller	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	276500.00	221500.00	Indonesia	\N
277	.CO.ID	domain-coid	domain	138000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	138000.00	138000.00	Indonesia	\N
278	.AC.ID	domain-acid	domain	66000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	66000.00	66000.00	Indonesia	\N
279	.SCH.ID	domain-schid	domain	66000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	66000.00	66000.00	Indonesia	\N
280	.WEB.ID	domain-webid	domain	66000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	66000.00	66000.00	Indonesia	\N
281	.MY.ID	domain-myid	domain	12000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	12000.00	12000.00	Indonesia	\N
282	.BIZ.ID	domain-bizid	domain	12000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	12000.00	12000.00	Indonesia	\N
283	.IE	domain-ie	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	313500.00	313500.00	International	\N
284	.IM	domain-im	domain	221500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	239500.00	221500.00	International	\N
285	.IMMO	domain-immo	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
286	.IMMOBILIEN	domain-immobilien	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
287	.IN	domain-in	domain	147500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	166000.00	147500.00	International	\N
288	.INC	domain-inc	domain	30805500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	38507000.00	38507000.00	Business	\N
289	.INDUSTRIES	domain-industries	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
290	.INFO	domain-info	domain	73000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	Popular	\N
291	.INK	domain-ink	domain	332000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	479500.00	479500.00	International	\N
292	.INSTITUTE	domain-institute	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Education	\N
293	.INSURE	domain-insure	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
294	.INTERNATIONAL	domain-international	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
295	.INVESTMENTS	domain-investments	domain	1291000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1476000.00	1476000.00	Finance	\N
296	.IO	domain-io	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	738000.00	Popular	\N
297	.IRISH	domain-irish	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
298	.IS	domain-is	domain	1033000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	996500.00	996500.00	International	\N
299	.ISTANBUL	domain-istanbul	domain	369000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
300	.IT	domain-it	domain	258000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	203000.00	258000.00	International	\N
301	.JETZT	domain-jetzt	domain	452000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	562500.00	452000.00	International	\N
302	.JEWELRY	domain-jewelry	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
303	.JP	domain-jp	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	406000.00	Location	\N
304	.KAUFEN	domain-kaufen	domain	553500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	619500.00	553500.00	International	\N
305	.KIM	domain-kim	domain	295000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	313500.00	295000.00	International	\N
306	.KITCHEN	domain-kitchen	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
307	.KIWI	domain-kiwi	domain	498000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
308	.KOELN	domain-koeln	domain	350500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	350500.00	International	\N
309	.KR	domain-kr	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	442500.00	442500.00	International	\N
310	.KYOTO	domain-kyoto	domain	1309500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1309500.00	378000.00	International	\N
311	.LA	domain-la	domain	756500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	940500.00	756500.00	International	\N
312	.LAND	domain-land	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Real Estate	\N
313	.LAT	domain-lat	domain	1199000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	2416500.00	1199000.00	International	\N
314	.LAW	domain-law	domain	1476000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1660500.00	1660500.00	International	\N
315	.LAWYER	domain-lawyer	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
316	.LEASE	domain-lease	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
317	.LEGAL	domain-legal	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
318	.LGBT	domain-lgbt	domain	996000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1051500.00	996000.00	International	\N
319	.LIFE	domain-life	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	424000.00	424000.00	Lifestyle	\N
320	.LIGHTING	domain-lighting	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
321	.LIMITED	domain-limited	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
322	.LIMO	domain-limo	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
323	.LINK	domain-link	domain	166000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	166000.00	Tech	\N
324	.LIVE	domain-live	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	406000.00	406000.00	Lifestyle	\N
325	.LIVESTREAMING	domain-livestreaming	domain	793000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1845000.00	793000.00	International	\N
326	.LLC	domain-llc	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	International	\N
327	.LOAN	domain-loan	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
328	.LOANS	domain-loans	domain	1291000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1476000.00	1476000.00	International	\N
329	.LOCKER	domain-locker	domain	756500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1420500.00	1420500.00	International	\N
330	.LOL	domain-lol	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
331	.LONDON	domain-london	domain	590000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	682500.00	590000.00	Location	\N
332	.LOVE	domain-love	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Lifestyle	\N
333	.LTD	domain-ltd	domain	111000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	332000.00	332000.00	Business	\N
334	.LTDA	domain-ltda	domain	756500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	867000.00	867000.00	International	\N
335	.LUXURY	domain-luxury	domain	7565000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	9226500.00	9226500.00	International	\N
336	.MAESTRO	domain-maestro	domain	2177000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	2177000.00	2177000.00	International	\N
337	.MAKEUP	domain-makeup	domain	8652000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	10516500.00	10516500.00	International	\N
338	.MANAGEMENT	domain-management	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Business	\N
339	.MARKET	domain-market	domain	516500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	590000.00	590000.00	Commerce	\N
340	.MARKETING	domain-marketing	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
341	.MBA	domain-mba	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	535000.00	442500.00	International	\N
342	.ME	domain-me	domain	92000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	Popular	\N
343	.MEDIA	domain-media	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Media	\N
344	.MEET	domain-meet	domain	295000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	International	\N
345	.MEME	domain-meme	domain	369000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	International	\N
346	.MEMORIAL	domain-memorial	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
347	.MEN	domain-men	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
348	.MENU	domain-menu	domain	516500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
349	.MOBI	domain-mobi	domain	350500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	387500.00	387500.00	International	\N
350	.MODA	domain-moda	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
351	.MOE	domain-moe	domain	295000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	313500.00	295000.00	International	\N
352	.MOM	domain-mom	domain	645500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	811500.00	645500.00	International	\N
353	.MONEY	domain-money	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Finance	\N
354	.MONSTER	domain-monster	domain	203000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	203000.00	International	\N
355	.MORTGAGE	domain-mortgage	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Real Estate	\N
356	.MOVIE	domain-movie	domain	3874500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	4613000.00	4613000.00	Media	\N
357	.MUSIC	domain-music	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	Media	\N
358	.MY	domain-my	domain	608500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	719500.00	608500.00	International	\N
359	.NAME	domain-name	domain	184500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	184500.00	184500.00	International	\N
360	.NET	domain-net	domain	186500.00	yr	Best Seller	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	208500.00	186500.00	Popular	\N
361	.NETWORK	domain-network	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Tech	\N
362	.NEW	domain-new	domain	350500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	461000.00	350500.00	International	\N
363	.NEWS	domain-news	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Media	\N
364	.NGO	domain-ngo	domain	774500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	774500.00	774500.00	International	\N
365	.NINJA	domain-ninja	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
366	.NL	domain-nl	domain	147500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	166000.00	147500.00	International	\N
367	.NOW	domain-now	domain	590000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	590000.00	590000.00	International	\N
368	.NYC	domain-nyc	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	Location	\N
369	.OBSERVER	domain-observer	domain	92000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	738000.00	738000.00	International	\N
370	.ONE	domain-one	domain	129000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	221500.00	International	\N
371	.ONG	domain-ong	domain	774500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	774500.00	774500.00	International	\N
372	.ONL	domain-onl	domain	111000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	203000.00	203000.00	International	\N
373	.ONLINE	domain-online	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	Tech	\N
374	.ORG	domain-org	domain	166000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	184500.00	166000.00	Popular	\N
375	.ORGANIC	domain-organic	domain	996000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1254000.00	1254000.00	International	\N
376	.PAGE	domain-page	domain	221500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	221500.00	International	\N
377	.PARIS	domain-paris	domain	645500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	885500.00	885500.00	International	\N
378	.PARTNERS	domain-partners	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
379	.PARTS	domain-parts	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
380	.PARTY	domain-party	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Lifestyle	\N
381	.PE	domain-pe	domain	1236000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1273000.00	1273000.00	International	\N
382	.PET	domain-pet	domain	276500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	332000.00	332000.00	International	\N
383	.PH	domain-ph	domain	904500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	904500.00	904500.00	International	\N
384	.PHOTO	domain-photo	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
385	.PHOTOGRAPHY	domain-photography	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Media	\N
386	.PHOTOS	domain-photos	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Media	\N
387	.PICS	domain-pics	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
388	.PICTURES	domain-pictures	domain	184500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	184500.00	International	\N
389	.PINK	domain-pink	domain	258000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	313500.00	313500.00	International	\N
390	.PIZZA	domain-pizza	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
391	.PLACE	domain-place	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
392	.PLUMBING	domain-plumbing	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
393	.PLUS	domain-plus	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
394	.POKER	domain-poker	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
395	.PORN	domain-porn	domain	1180500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1328000.00	1328000.00	International	\N
396	.PRESS	domain-press	domain	922500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1070000.00	1070000.00	Media	\N
397	.PRO	domain-pro	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	Business	\N
398	.PRODUCTIONS	domain-productions	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Media	\N
399	.PROMO	domain-promo	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Commerce	\N
400	.PROPERTIES	domain-properties	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Real Estate	\N
401	.PROPERTY	domain-property	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Real Estate	\N
402	.PROTECTION	domain-protection	domain	30805500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	38507000.00	38507000.00	International	\N
403	.PUB	domain-pub	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
404	.PW	domain-pw	domain	184500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	221500.00	International	\N
405	.QUEST	domain-quest	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	424000.00	424000.00	International	\N
406	.RACING	domain-racing	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
407	.RADIO	domain-radio	domain	2765000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	2950000.00	2950000.00	International	\N
408	.REALESTATE	domain-realestate	domain	1494500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1845000.00	1845000.00	Real Estate	\N
409	.RECIPES	domain-recipes	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
410	.RED	domain-red	domain	258000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	313500.00	313500.00	International	\N
411	.REHAB	domain-rehab	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
412	.RENT	domain-rent	domain	922500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1070000.00	1070000.00	Real Estate	\N
413	.RENTALS	domain-rentals	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Real Estate	\N
414	.REPAIR	domain-repair	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
415	.REPORT	domain-report	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
416	.REPUBLICAN	domain-republican	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
417	.REST	domain-rest	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
418	.RESTAURANT	domain-restaurant	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
419	.REVIEW	domain-review	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
420	.REVIEWS	domain-reviews	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
421	.RICH	domain-rich	domain	30805500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	38507000.00	38507000.00	International	\N
422	.RIP	domain-rip	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
423	.ROCKS	domain-rocks	domain	166000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	166000.00	International	\N
424	.RODEO	domain-rodeo	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
425	.RUN	domain-run	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
426	.SALE	domain-sale	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Commerce	\N
427	.SALON	domain-salon	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Lifestyle	\N
428	.SARL	domain-sarl	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
429	.SCHOOL	domain-school	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Education	\N
430	.SCHULE	domain-schule	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
431	.SCIENCE	domain-science	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
432	.SECURITY	domain-security	domain	30805500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	38507000.00	38507000.00	International	\N
433	.SERVICES	domain-services	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Business	\N
434	.SEX	domain-sex	domain	1180500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1328000.00	1328000.00	International	\N
435	.SEXY	domain-sexy	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
436	.SG	domain-sg	domain	811500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	811500.00	811500.00	Location	\N
437	.SH	domain-sh	domain	424000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	535000.00	424000.00	International	\N
438	.SHOES	domain-shoes	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
439	.SHOP	domain-shop	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	479500.00	479500.00	Commerce	\N
440	.SHOPPING	domain-shopping	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Commerce	\N
441	.SHOW	domain-show	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Media	\N
442	.SINGLES	domain-singles	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Lifestyle	\N
443	.SITE	domain-site	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	424000.00	424000.00	Tech	\N
444	.SKI	domain-ski	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
445	.SKIN	domain-skin	domain	369000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	International	\N
446	.SOCCER	domain-soccer	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
447	.SOCIAL	domain-social	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Lifestyle	\N
448	.SOFTWARE	domain-software	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Tech	\N
449	.SOLAR	domain-solar	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
450	.SOLUTIONS	domain-solutions	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Business	\N
451	.SOY	domain-soy	domain	369000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	442500.00	369000.00	International	\N
452	.SPACE	domain-space	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	International	\N
453	.STORE	domain-store	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	774500.00	774500.00	Commerce	\N
454	.STREAM	domain-stream	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
455	.STUDIO	domain-studio	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Media	\N
456	.STUDY	domain-study	domain	406000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	479500.00	479500.00	Education	\N
457	.STYLE	domain-style	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
458	.SUCKS	domain-sucks	domain	3246500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	3615500.00	3615500.00	International	\N
459	.SUPPLIES	domain-supplies	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
460	.SUPPLY	domain-supply	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
461	.SUPPORT	domain-support	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
462	.SURGERY	domain-surgery	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
463	.SYSTEMS	domain-systems	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Tech	\N
464	.TATTOO	domain-tattoo	domain	479500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	664000.00	664000.00	International	\N
465	.TAX	domain-tax	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Finance	\N
466	.TAXI	domain-taxi	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
467	.TEAM	domain-team	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
468	.TECH	domain-tech	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	701000.00	701000.00	Tech	\N
469	.TECHNOLOGY	domain-technology	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Tech	\N
470	.TEL	domain-tel	domain	258000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	313500.00	313500.00	International	\N
471	.TENNIS	domain-tennis	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
472	.THEATER	domain-theater	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
473	.THEATRE	domain-theatre	domain	30805500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	38507000.00	38507000.00	International	\N
474	.TICKETS	domain-tickets	domain	6153000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	7691500.00	7691500.00	International	\N
475	.TIPS	domain-tips	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
476	.TIRES	domain-tires	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
477	.TODAY	domain-today	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	International	\N
478	.TOKYO	domain-tokyo	domain	221500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	221500.00	221500.00	Location	\N
479	.TOOLS	domain-tools	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
480	.TOP	domain-top	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	147500.00	147500.00	International	\N
481	.TOURS	domain-tours	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Location	\N
482	.TOWN	domain-town	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Location	\N
483	.TOYS	domain-toys	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
484	.TRADE	domain-trade	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Business	\N
485	.TRADING	domain-trading	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Finance	\N
486	.TRAINING	domain-training	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
487	.TRAVEL	domain-travel	domain	1476000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1771000.00	1771000.00	Location	\N
488	.TUBE	domain-tube	domain	369000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	International	\N
489	.TV	domain-tv	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	516500.00	516500.00	Media	\N
490	.UK	domain-uk	domain	129000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	129000.00	129000.00	Location	\N
491	.UNIVERSITY	domain-university	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Education	\N
492	.UNO	domain-uno	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
493	.US	domain-us	domain	73500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	147500.00	147500.00	Location	\N
494	.VACATIONS	domain-vacations	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Location	\N
495	.VC	domain-vc	domain	535000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	608500.00	535000.00	International	\N
496	.VEGAS	domain-vegas	domain	608500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	885500.00	608500.00	International	\N
497	.VENTURES	domain-ventures	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Business	\N
498	.VET	domain-vet	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
499	.VIDEO	domain-video	domain	313500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	369000.00	369000.00	Media	\N
500	.VILLAS	domain-villas	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Real Estate	\N
501	.VIN	domain-vin	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
502	.VIP	domain-vip	domain	221500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	258000.00	258000.00	Lifestyle	\N
503	.VISION	domain-vision	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
504	.VODKA	domain-vodka	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
505	.VOTE	domain-vote	domain	1033000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1180500.00	1180500.00	International	\N
506	.VOTING	domain-voting	domain	1033000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1180500.00	1180500.00	International	\N
507	.VOTO	domain-voto	domain	1033000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1180500.00	1180500.00	International	\N
508	.VOYAGE	domain-voyage	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	Location	\N
509	.WATCH	domain-watch	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
510	.WEBCAM	domain-webcam	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
511	.WEBSITE	domain-website	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	295000.00	295000.00	Tech	\N
512	.WEDDING	domain-wedding	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
513	.WIKI	domain-wiki	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Education	\N
514	.WIN	domain-win	domain	111000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	203000.00	203000.00	International	\N
515	.WINE	domain-wine	domain	738000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	848500.00	848500.00	International	\N
516	.WORK	domain-work	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	129000.00	129000.00	Business	\N
517	.WORKS	domain-works	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Business	\N
518	.WORLD	domain-world	domain	55500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	461000.00	461000.00	Lifestyle	\N
519	.WTF	domain-wtf	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
520	.XBOX	domain-xbox	domain	1845000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1845000.00	1845000.00	International	\N
521	.XYZ	domain-xyz	domain	40000.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	184500.00	184500.00	Popular	\N
522	.YOGA	domain-yoga	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	International	\N
523	.ZONE	domain-zone	domain	442500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	553500.00	553500.00	Lifestyle	\N
524	.ZZ	domain-zz	domain	1088500.00	yr	\N	f	2025-12-24 19:07:22	2025-12-24 19:07:22	\N	1088500.00	1088500.00	International	\N
11	.0Z	domain-0z	domain	1107000.00	yr	\N	f	2025-12-24 19:07:21	2025-12-24 19:27:28	\N	424000.00	424000.00	Numeric	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":null,"type":"none","value":"0","label":null},"biennially":{"custom_price":null,"type":"none","value":"0","label":null},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
525	.4sale	domain-4sale	domain	738000.00	yr	\N	f	2025-12-24 19:39:56	2025-12-24 19:39:56	\N	369000.00	369000.00	Numeric	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":null,"type":"none","value":"0","label":null},"biennially":{"custom_price":null,"type":"none","value":"0","label":null},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
139	.COM	domain-com	domain	276500.00	yr	Best Seller	f	2025-12-24 19:07:21	2025-12-24 19:42:55	\N	341000.00	276500.00	Popular	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":null,"type":"none","value":"0","label":null},"biennially":{"custom_price":null,"type":"none","value":"0","label":null},"register":{"type":"percent","value":"20","label":"Off 1st Year"},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"percent","value":"23","label":"OFF"}}
4	Shared Starter	shared-starter	hosting	90500.00	mo	\N	f	2025-12-24 19:07:21	2025-12-24 19:46:24	\N	0.00	0.00	General	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":"902000","type":"percent","value":"59","label":"Off 1st Year"},"biennially":{"custom_price":"1695500","type":"percent","value":"68","label":"Off 2 Year"},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
5	Shared Business	shared-business	hosting	127000.00	mo	Best Value	f	2025-12-24 19:07:21	2025-12-24 19:48:40	\N	0.00	0.00	General	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":"1381500","type":"percent","value":"57","label":"Off 1st Year"},"biennially":{"custom_price":"2414500","type":"percent","value":"67","label":"Off 2 Year"},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
6	Shared Premium	shared-premium	hosting	182500.00	mo	\N	f	2025-12-24 19:07:21	2025-12-24 19:50:21	\N	0.00	0.00	General	{"monthly":{"custom_price":null,"type":"none","value":"0","label":null},"quarterly":{"custom_price":null,"type":"none","value":"0","label":null},"annually":{"custom_price":"2082500","type":"percent","value":"50","label":"Off 1st Year"},"biennially":{"custom_price":"4149000","type":"percent","value":"55","label":"Off 2 Year"},"register":{"type":"none","value":"0","label":null},"renew":{"type":"none","value":"0","label":null},"transfer":{"type":"none","value":"0","label":null}}
\.


--
-- Data for Name: saas_products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.saas_products (id, user_id, name, slug, category, tagline, description, price, thumbnail, status, created_at, updated_at, features, plans) FROM stdin;
1	1	Professional Business Email	business-email	Productivity	Email profesional aman, bebas iklan dengan domain Anda sendiri.	Tingkatkan kredibilitas bisnis Anda dengan email domain sendiri. Pilih paket tahunan untuk hemat atau coba gratis selama 2 bulan.\n\nFitur Utama:\n- POP3/IMAP/Webmail Access\n- Anti-Spam Protection\n- 2FA Security\n- Full Mobile Sync	18000.00	assets/Saas/email.jpg	approved	2025-12-19 12:42:46	2025-12-19 12:42:46	["POP3\\/IMAP\\/Webmail Access","Anti-Spam Protection","2FA Security","Full Mobile Sync"]	{"ultimate":{"name":"Ultimate","tag":"Best Value","yearly":{"price_mo":73000,"save_text":"Save 33%","total_year":876000,"renew_text":"Renews at Rp 1.305.000\\/yr"},"trial":{"price_mo":0,"save_text":"Free 2 Months","total_year":0,"renew_text":"Renews at Rp 1.305.000\\/yr"},"features":["5 mailboxes","75GB storage","Docs & Sheets","Premium Delivery"]},"pro":{"name":"Pro","tag":null,"yearly":{"price_mo":46000,"save_text":"Save 28%","total_year":552000,"renew_text":"Renews at Rp 760.000\\/yr"},"trial":{"price_mo":0,"save_text":"Free 2 Months","total_year":0,"renew_text":"Renews at Rp 760.000\\/yr"},"features":["3 mailboxes","30GB storage","Mobile sync"]},"starter":{"name":"Starter","tag":null,"yearly":{"price_mo":18000,"save_text":"Save 20%","total_year":216000,"renew_text":"Renews at Rp 270.000\\/yr"},"trial":{"price_mo":0,"save_text":"Free 2 Months","total_year":0,"renew_text":"Renews at Rp 270.000\\/yr"},"features":["1 mailbox","5GB storage"]}}
2	1	FastVPN Secure Proxy	fast-vpn	Security	Aman, Cepat, dan Anonim. Buka blokir konten di mana saja.	Lindungi privasi online Anda dengan FastVPN. Enkripsi tingkat militer menyembunyikan IP Anda dari peretas dan pelacak.\n\nFitur Utama:\n- 1000+ Server di 50+ Negara\n- No-Logs Policy\n- Unlimited Devices\n- Unblock Netflix/Streaming	18000.00	assets/Saas/vpn.jpg	approved	2025-12-19 12:42:46	2025-12-19 12:42:46	["1000+ Server di 50+ Negara","No-Logs Policy","Unlimited Devices","Unblock Netflix\\/Streaming"]	{"monthly":{"name":"Monthly Plan","price_display":18000,"price_crossed":145000,"discount_tag":"87% off","renew_text":"Renews at Rp 145.000\\/mo","btn_text":"Get 1-month plan","cycle":"monthly","real_price":18000},"yearly":{"name":"1-year plan","tag":"PROMO","discount_tag":"65% off","price_display":18500,"total_text":"You pay Rp 222.000","renew_text":"Renews at Rp 640.000\\/yr","btn_text":"Get 1-year plan","cycle":"annually","real_price":222000},"triennially":{"name":"3-year plan","discount_tag":"76% off","price_display":35000,"total_text":"You pay Rp 1.260.000","renew_text":"","btn_text":"Get 3-year plan","cycle":"triennially","real_price":1260000}}
3	1	SSL Certificates	ssl-certificates	Security	Amankan website Anda dengan enkripsi standar industri.	Pilih dari berbagai jenis sertifikat SSL untuk kebutuhan personal, bisnis, hingga e-commerce.\n\nFitur Umum:\n- Enkripsi 256-bit\n- Tanda Gembok HTTPS\n- Meningkatkan SEO\n- Garansi Uang Kembali	109000.00	assets/Saas/ssl.jpg	approved	2025-12-19 12:42:46	2025-12-19 12:42:46	["Enkripsi 256-bit","Tanda Gembok HTTPS","Meningkatkan SEO","Garansi Uang Kembali"]	{"positive_ssl":{"name":"PositiveSSL","price_display":109000,"real_price":109000,"renew_text":"Renews at Rp 127.000\\/yr","discount_tag":"14% off","features":["Domain (DV)","Single Domain"],"cycle":"annually"},"essential_ssl":{"name":"EssentialSSL","price_display":253000,"real_price":253000,"renew_text":"Renews at Rp 303.000\\/yr","discount_tag":"17% off","features":["Domain (DV)","Single Domain"],"cycle":"annually"},"ev_ssl":{"name":"EV SSL","price_display":835000,"real_price":835000,"renew_text":"Renews at Rp 1.002.000\\/yr","discount_tag":"17% off","features":["Extended (EV)","Single Domain"],"cycle":"annually"},"positive_wildcard":{"name":"PositiveSSL Wildcard","price_display":726000,"real_price":726000,"renew_text":"Renews at Rp 806.000\\/yr","discount_tag":"10% off","features":["Domain (DV)","Wildcard"],"cycle":"annually"},"premium_ssl":{"name":"PremiumSSL","price_display":908000,"real_price":908000,"renew_text":"Renews at Rp 1.089.000\\/yr","discount_tag":"17% off","features":["Organization (OV)","Single Domain"],"cycle":"annually"},"multi_domain":{"name":"PositiveSSL Multi-Domain","price_display":354000,"real_price":354000,"renew_text":"Renews at Rp 425.000\\/yr","discount_tag":"17% off","tag":"3 Domains","features":["Domain (DV)","Multi Domain"],"cycle":"annually"}}
\.


--
-- Data for Name: saas_reviews; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.saas_reviews (id, user_id, saas_slug, rating, comment, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
puT1KmsmDcXfZHu8KYjNFM6vTwEradGbs5vB2O8A	\N	182.253.150.4	Mozilla/5.0 (iPhone; CPU iPhone OS 18_6_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/145.0.7632.108 Mobile/15E148 Safari/604.1	YTozOntzOjY6Il90b2tlbiI7czo0MDoia2puQjhFN0RScWh1V2JhYmNqcUtqMTVJQU9mbk90MVptTHhJOGEyayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQvY2hhdGJvdC9oaXN0b3J5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1773369221
njQ6egJBeyLgkaz4Yiv7YTLUg3LpHkXzeVjlR68u	\N	114.10.147.232	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36	YTozOntzOjY6Il90b2tlbiI7czo0MDoia3lHZTRVeDRMdFdrS2EzWElmbmpXN1pySEIwNlhobkp2ZEsyYnhRayI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQvY2hhdGJvdC9oaXN0b3J5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==	1773371569
FgHFjtnKUKkxm6rLEYh6GNHHcE09MpRRogzS7k9t	\N	18.201.221.112	Mozilla/5.0 (compatible; NetcraftSurveyAgent/1.0; +info@netcraft.com)	YTozOntzOjY6Il90b2tlbiI7czo0MDoiMENRT0EwejFvd0VSQ1N6NlEzTUEyRk1RN3VxTG1MQ3pQN091VHNqRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjI6Imh0dHBzOi8vZnV0dXJlY2xvdWQuaWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19	1773371561
\.


--
-- Data for Name: subscriptions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.subscriptions (id, user_id, type, name, price, reg_date, due_date, ip_address, status, created_at, updated_at) FROM stdin;
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
12	Muhamad Nur Salam (Alam)	aaallaaamm03@gmail.com	2025-12-16 09:49:33	$2y$12$Nd.hsNjkhu1qw7KUGhKgFuBPTZ6VdfFmrPZpCNz8ZhHTi1ecqNnnu	\N	2025-12-16 09:49:33	2025-12-16 09:49:33	111426406043668453037	https://lh3.googleusercontent.com/a/ACg8ocJJagA27yrJ8szuqqO7z94RbEbo5EOQK6WySQZGCYPMuh6jmLI=s96-c	GOOGLE-761302	\N	\N	\N	\N	\N	ID	muhamad3573	Muhamad	Nur Salam (Alam)	user	\N	\N	\N	f
9	Admin Sixperience	info@sixperience.id	2025-12-17 13:03:43	$2y$12$880xUmx3SiyDv5XeAuoMGurZFgZ/B6e6i3kSHBukDDjBKcAWRwjSS	\N	2025-12-13 10:44:18	2025-12-17 13:03:43	\N	\N	\N	\N	\N	\N	\N	\N	ID	sixperience	Admin	Sixperience	user	\N	\N	\N	f
10	Admin DNY Filter	info@dny-filterindo.co.id	2025-12-17 13:03:43	$2y$12$ddarVCzLsemVd10doapgMOGhR3NGrC5pR5jZwvwkrX6IksvLgvO0m	\N	2025-12-13 10:44:18	2025-12-17 13:03:43	\N	\N	\N	\N	\N	\N	\N	\N	ID	dnyfilterindo	Admin	DNY Filter	user	\N	\N	\N	f
15	Admin FKUB Jakpus	info@fkubjakpus.or.id	2025-12-17 13:03:44	$2y$12$2WfvPsD6FYkNRQnM7QKc0OfEDyitcczoS.iIog2qr7mV3kLrl7i4S	\N	2025-12-16 12:28:24	2025-12-17 13:03:44	\N	\N	\N	\N	\N	\N	\N	\N	ID	fkubjakpus	Admin	FKUB Jakpus	user	\N	\N	\N	f
5	gispi wibu	gispiwibu@gmail.com	2025-12-05 09:18:46	$2y$12$IHlXzoSm09zIvUozmKltA.5wbogtA2A0wVWWRh8hmpL2JoZqwBQ.u	\N	2025-12-05 09:18:46	2025-12-17 13:30:15	109054687011289659101	https://lh3.googleusercontent.com/a/ACg8ocJqU5527ZmD7aN4pQ9gniSolUE2mXgFDG6KjfmPy-zb5xLdFQ=s96-c	GOOGLE-281500	\N	\N	\N	\N	\N	ID	gispi2753	gispi	wibu	user	\N	\N	\N	t
1	FutureCloud Official	gispi.desu@gmail.com	2025-12-01 11:23:44	$2y$12$KN75Gx4th/xxh5ZIbaulJuI1f3jxLoZcuj8CVh8W.CpWiYyWm3BDK	\N	2025-12-01 11:23:44	2025-12-19 12:38:50	115999999275364563672	https://lh3.googleusercontent.com/a/ACg8ocJJUr5dJ2KHrzl4WagtSxYzs0xDtgw2HX_4usqEiizUUpQbLLQY=s96-c	GOOGLE-523825	\N	Alamat Saya	\N	\N	\N	ID	ghryshvi9022	Ghryshvi	Dzickra	partner	PT Maju Terdepan	083234562456	approved	f
16	Syahfiq Hikmal	dikasyahfiq@gmail.com	2026-02-06 00:41:23	$2y$12$456G9fVo1R3sFgQTaAxYvewVs6U/algrS/QH6CvVhzT25.nCxiCGG	\N	2026-02-06 00:41:23	2026-02-06 00:41:25	\N	\N	PENDING-617160	\N	\N	\N	\N	\N	ID	makina	Syahfiq	Hikmal	user	\N	\N	\N	f
\.


--
-- Name: admins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.admins_id_seq', 1, true);


--
-- Name: carts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.carts_id_seq', 6, true);


--
-- Name: chat_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chat_messages_id_seq', 92, true);


--
-- Name: chat_sessions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chat_sessions_id_seq', 637, true);


--
-- Name: chatbot_responses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chatbot_responses_id_seq', 12, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


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

SELECT pg_catalog.setval('public.migrations_id_seq', 33, true);


--
-- Name: order_items_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.order_items_id_seq', 7, true);


--
-- Name: orders_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.orders_id_seq', 6, true);


--
-- Name: portfolios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.portfolios_id_seq', 2, true);


--
-- Name: product_features_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.product_features_id_seq', 1083, true);


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 525, true);


--
-- Name: saas_products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.saas_products_id_seq', 3, true);


--
-- Name: saas_reviews_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.saas_reviews_id_seq', 1, false);


--
-- Name: subscriptions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.subscriptions_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 16, true);


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
-- Name: chatbot_responses chatbot_responses_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_responses
    ADD CONSTRAINT chatbot_responses_pkey PRIMARY KEY (id);


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
-- PostgreSQL database dump complete
--

\unrestrict glcUoaVwfP8AN0QtMpZ5vfgB5g7cIhiaqa8krpfo8TKh2YTICSWYhaACVs0ccEg

