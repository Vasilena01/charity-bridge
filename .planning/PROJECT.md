# CharityBridge

## What This Is

A web platform for creating and managing charitable campaigns where people can contribute through monetary donations, goods/services at cost+donation pricing, volunteer hours, or company support. Campaign organizers set goals and deadlines, while volunteers and companies participate in campaigns that matter to them.

## Core Value

Users can run complete charitable campaigns from creation to goal completion, tracking all types of contributions (money, goods, labor, company support) in one place.

## Requirements

### Validated

(None yet — ship to validate)

### Active

- [ ] Campaign organizers can create goal-based campaigns with deadlines
- [ ] Organizers can add goods/services with production cost + donation amount (fixed total price)
- [ ] Volunteers can browse public campaigns and participate
- [ ] Volunteers can contribute virtual currency, sign up for volunteer hours, or pledge goods
- [ ] Companies can register existing campaigns and expand their reach
- [ ] Campaigns track progress toward monetary and non-monetary goals
- [ ] Some campaigns are public, others are private (invite-only)
- [ ] Three distinct user roles: Volunteers/Donors, Campaign Organizers, Company Representatives

### Out of Scope

- Real payment processing (using virtual currency for v1) — Adds external dependencies and complexity, defer to v2
- Mobile native apps (web-first approach) — Focus on core functionality first
- Real-time notifications — Not essential for v1 campaign lifecycle
- Multi-language support — Start with single language, expand later

## Context

**Campaign Types Mentioned:** Christmas bazaars, online games with charitable purpose

**Donation Models:**
- **Monetary:** Virtual currency donations (no real payment integration in v1)
- **Goods/Services:** Fixed pricing (production cost + donation amount)
- **Labor/Volunteering:** Hour-based contributions
- **Company Support:** Companies contribute and promote campaigns

**User Journey:**
1. Organizer creates campaign with goal and deadline
2. Organizer adds items (goods/services) or volunteer opportunities
3. Campaign is made public or kept private
4. Volunteers browse and participate (donate virtual money, sign up for hours, pledge goods)
5. Campaign tracks progress toward goal
6. Campaign reaches goal or deadline

## Constraints

- **Tech Stack:** PHP backend (no specific framework mentioned yet), MySQL database, vanilla HTML/CSS/JavaScript (no React/Angular/Vue)
- **Payment:** Virtual currency only in v1 (no Stripe/PayPal integration)
- **Hosting:** Not specified yet (local development first)
- **Timeline:** Not specified

## Key Decisions

| Decision | Rationale | Outcome |
|----------|-----------|---------|
| Virtual currency instead of real payments in v1 | Simplifies development, removes compliance/legal complexity, allows testing core flows | — Pending |
| Three distinct user roles | Clear separation of concerns: helpers, organizers, companies have different needs | — Pending |
| Goal-based campaigns with deadlines | Like Kickstarter model - creates urgency and clear success criteria | — Pending |
| Mixed public/private visibility | Gives organizers control over campaign reach | — Pending |
| PHP + MySQL + Vanilla JS | User constraint - no frameworks, keeping it simple | — Pending |

## Evolution

This document evolves at phase transitions and milestone boundaries.

**After each phase transition** (via `/gsd-transition`):
1. Requirements invalidated? → Move to Out of Scope with reason
2. Requirements validated? → Move to Validated with phase reference
3. New requirements emerged? → Add to Active
4. Decisions to log? → Add to Key Decisions
5. "What This Is" still accurate? → Update if drifted

**After each milestone** (via `/gsd-complete-milestone`):
1. Full review of all sections
2. Core Value check — still the right priority?
3. Audit Out of Scope — reasons still valid?
4. Update Context with current state

---
*Last updated: 2026-05-03 after initialization*
