# Sentry Integration Feedback

## Setup Flow & Documentation

1. **Initial Setup**

    - Spent 30 mins learning Laravel basics
    - Created single project in Sentry (vs. separate FE/BE/API projects) to keep things simple
    - Opted for traditional docs exploration vs following the integration steps
        - Could promote a "5-minute quick start" to draw users to this path

2. **Installation & Configuration**

    - Followed Sentry docs to install & enable Sentry
    - "Configure the Sentry DSN with this command"
        - Nice that Sentry auto-populated the DSN. However, it's hard to tell that given the content well width. A simple callout could go a long way. e.g https://share.cleanshot.com/dC2hNNNx
        - Clicking for more info shows a disconnected popover with odd purple highlighting. https://share.cleanshot.com/y7g6gmMl

3. **Test Events**

    - CLI prompted me to send a test event during the Configure step. It worked great.
    - Docs later show how to fire a test event [Laravel | Sentry for Laravel](https://docs.sentry.io/platforms/php/guides/laravel/#verify) - consider mentioning the CLI option here to avoid confusion with multiple test events. Multiple is fine (maybe best) but felt a little uncertain.

4. **Tracing Setup**

    - [Configure](https://docs.sentry.io/platforms/php/guides/laravel/#tracing) The **1.0** value was pre-set in .env from earlier steps. Ideally the docs and quickstart are more in sync to reduce cognitive spike in navigating this.
    - Also the docs say this can be set in **.env** or **config/sentry.php**. It may be worth recommending the .env (as the snippet shows) over config for environment flexibility.
    - Consider moving additional tracing docs up in the content tree - it's core functionality.

5. **Configuration Options**
    - I didn't explore a lot of these. I wasn't sure what I needed, but I'd imagine with more intimate knowledge of the Laravel/PHP landscape, this would be easier.
    - Options section repeats tracing configuration.
    - I understood conceptually but didn't quite understand the Advanced Sample Rate example [Laravel Options | Sentry for Laravel](https://docs.sentry.io/platforms/php/guides/laravel/configuration/laravel-options/#advanced-sample-rate).

## General Documentation Issues

### Cross-Platform Navigation

-   Sometimes the docs & AI integration brings me to framework config that I'm not using e.g. "How do I set up session replays for Laravel?" -> links to content about next.js, etc.
-   [Error Issues](https://docs.sentry.io/product/issues/issue-details/error-issues/) UI is outdated so not super helpful in connecting the dots.
-   [Platform Specific Content](https://docs.sentry.io/platform-redirect/?next=%2Fenriching-events%2Ftags%2F) no info on Laravel tags?
-   Other packages (e.g React) have many integrations, is there a future for Laravel like this?

## Documentation Suggestions

-   Find balance between product knowledge reference and straight implementation.
-   Before "Options" discuss what is auto instrumented vs custom options.
    -   I figure it's important to know early on about tagging, contexts, etc to support user's specific app. "Options" is mostly reference material - "options before settings" makes some sense - I would want to hear more about any data we have or what prompted the current order.
    -   Move up tracing in content tree. This is critical Sentry bread & butter.
-   What to do once you see an error? - link to [Issues](https://docs.sentry.io/product/issues/) in the flow.

## Sentry Feedback

### Dashboard

-   Dashboard says "No instrumentation" in trace view in some places. [See here](https://share.cleanshot.com/GfFVpqFL)
    -   Is that ever a real issue?
    -   I tried adding custom instrumentation to see more info.
-   What's the sort order in [traces panel](https://share.cleanshot.com/4QVdfYgC)? Would be cool to quickly sort by timestamp.

### Frontend Performance

-   I wasn't seeing any data under _Insights -> Frontend_ in the Sentry sidebar, so I tried experimenting with custom instrumentation.
-   I saw [in the docs](https://docs.sentry.io/product/insights/frontend/) it's only available on Team and Business plans.
-   But eventually I did see stuff populate here. Wasn't clear on this?

### Visual Issues

-   User feedback styles [CleanShot 2025-03-31 at 23.36.57](https://share.cleanshot.com/r8pzSR9J)
-   Email assets for dark mode [CleanShot 2025-04-01 at 15.52.20](https://share.cleanshot.com/RJ7Bj5Lz)

## Positive Experiences

### Core Features

-   Tooling ease of use.
-   Great breakdown of Tracing concepts.
-   Dashboard
    -   Dashboard templates - great time saver.
    -   Stats - quick high-level views.
    -   User feedback integration - reduces # of tools in the toolbox.

## Future Exploration

### Advanced Features

-   Profiling [Set Up Profiling | Sentry for Laravel](https://docs.sentry.io/platforms/php/guides/laravel/profiling/) could certainly be useful in a larger application but integration was beyond my scope at the moment.
-   [LLM Monitoring](https://docs.sentry.io/product/#llm-monitoring) - this sounds interesting!
