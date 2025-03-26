import "./bootstrap";
import * as Sentry from "@sentry/browser";
import { browserTracingIntegration, replayIntegration } from "@sentry/browser";

try {
    Sentry.init({
        dsn: window.SENTRY_DSN,
        integrations: [
            browserTracingIntegration({
                tracePropagationTargets: ["localhost", /^http:\/\/localhost/],
            }),
            replayIntegration(),
        ],
        // Performance Monitoring
        tracesSampleRate: 1.0,
        // Session Replay
        replaysSessionSampleRate: 0.1,
        replaysOnErrorSampleRate: 1.0,
    });

    // Add form submission handler
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector("form");
        form.addEventListener("submit", (e) => {
            // Example: Throw error if email contains 'test'
            const email = form.querySelector("#email").value;
            if (email.includes("test")) {
                throw new Error("Test email validation error");
            }
            // Form will submit normally if no error is thrown
        });
    });
} catch (error) {
    console.warn("Sentry initialization failed:", error);
}
