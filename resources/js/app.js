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

        // Add test endpoints handler
        const testButton = document.getElementById("testEndpoints");
        const testResults = document.getElementById("testResults");

        if (testButton) {
            testButton.addEventListener("click", async () => {
                testButton.disabled = true;
                testResults.innerHTML = "Running tests...\n\n";

                // Test endpoints that can't be triggered through the form
                const endpoints = [
                    { name: "Basic Exception", url: "/debug-sentry" },
                    { name: "Database Error", url: "/debug-db" },
                    { name: "Authentication Error", url: "/debug-auth" },
                    { name: "404 Error", url: "/debug-not-found" },
                    { name: "Custom Error", url: "/trigger-error" },
                ];

                for (const endpoint of endpoints) {
                    try {
                        const response = await fetch(endpoint.url);
                        const status = response.ok ? "success" : "error";
                        testResults.innerHTML += `${endpoint.name}: <span class="test-status ${status}">${response.status}</span>\n`;
                    } catch (error) {
                        testResults.innerHTML += `${endpoint.name}: <span class="test-status error">Error</span>\n`;
                    }
                }

                testButton.disabled = false;
                testResults.innerHTML +=
                    "\nAll tests completed. Check your Sentry dashboard for details.";
            });
        }
    });
} catch (error) {
    console.warn("Sentry initialization failed:", error);
}
