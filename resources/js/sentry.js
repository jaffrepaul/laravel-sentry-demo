import * as Sentry from "@sentry/browser";

Sentry.init({
    dsn: "https://edcbbf7d263481d1d6452a1195bc206e@o4509013641854976.ingest.us.sentry.io/4509030184714240",
    // Performance Monitoring
    tracesSampleRate: 1.0,
    // Session Replay
    replaysSessionSampleRate: 0.1,
    replaysOnErrorSampleRate: 1.0,
});
