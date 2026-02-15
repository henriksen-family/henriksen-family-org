# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

Static website for **The Henriksen Family Giving Fund**, a family-led charitable fund in Layton, Utah. The site is a single-page marketing/application site with a grant application form and contact form.

## Architecture

- **No build system** — plain HTML, CSS, and vanilla JS. No bundler, no framework, no package manager.
- **`index.html`** — Single-page site with all sections (hero, mission, what we do, grants, donors, apply form, FAQs/contact, footer). Contains inline `<script>` at the bottom for mobile menu, form logic, and scroll animations (IntersectionObserver).
- **`styles.css`** — All styles in one file. Uses CSS custom properties defined in `:root` for the brand palette (navy `#1A2F4D`, evergreen `#2C583D`, gold `#A18C46`, ivory `#F7F5F0`). Responsive breakpoint at 768px.
- **`thank-you.html`** — Post-submission confirmation page (redirected to by the PHP backend).
- **`scripts/send-mail.php`** — Server-side form handler using PHP `mail()`. Handles both the grant application form and the contact form, distinguished by which POST fields are present. Emails go to `justin.henriksen@gmail.com`.
- **`images/`** — Logo variants (tree-logo, wordmark, favicon, letterhead) and section imagery.

## Design System

- **Fonts**: Headings use `Work Sans`, body uses `Source Sans 3` (loaded from Google Fonts).
- **Scroll animations**: Elements with class `animate-on-scroll` fade/slide in via IntersectionObserver. Directional variants: `slide-left`, `slide-right`. Stagger delays: `delay-1`, `delay-2`, `delay-3`.
- **Form validation**: Uses CSS `:user-invalid` / `:user-valid` pseudo-classes for inline validation styling (no JS validation library).

## Development

To preview locally, serve the directory with any static file server (e.g., `python -m http.server` or VS Code Live Server). The PHP form handler requires a PHP-capable server for form submission testing.
