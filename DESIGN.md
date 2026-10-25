---
name: Fikri Amrullah — Build Log
description: A working field notebook for a full-stack Laravel developer, built from paper, graphite, cobalt annotations, manila index tabs, and ledger rows.
colors:
  cobalt: "#1f4ed8"
  cobalt-deep: "#173aa8"
  cobalt-wash: "#e8edfb"
  stamp: "#b4432f"
  stamp-wash: "#f3e4df"
  manila: "#e7dcc2"
  manila-deep: "#d8c8a4"
  manila-ink: "#6f5c33"
  success: "#2f6b4f"
  success-wash: "#e6f0e9"
  paper: "#f5f3ec"
  paper-raised: "#fbfaf6"
  paper-deep: "#ebe7db"
  ink: "#15181b"
  ink-soft: "#4c5258"
  ink-faint: "#5f666c"
  line: "#d8d4c7"
  line-strong: "#b9b4a5"
typography:
  display:
    fontFamily: "Bricolage Grotesque, Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "clamp(3.4rem, 7vw, 6rem)"
    fontWeight: 600
    lineHeight: 0.94
    letterSpacing: "-0.04em"
  headline:
    fontFamily: "Bricolage Grotesque, Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "clamp(2.4rem, 4.5vw, 4rem)"
    fontWeight: 600
    lineHeight: 0.94
    letterSpacing: "-0.04em"
  title:
    fontFamily: "Bricolage Grotesque, Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "1.75rem"
    fontWeight: 600
    lineHeight: 1.1
    letterSpacing: "-0.025em"
  body:
    fontFamily: "Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "1.0625rem"
    fontWeight: 400
    lineHeight: 1.75
    letterSpacing: "normal"
  label:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "0.6875rem"
    fontWeight: 500
    lineHeight: 1
    letterSpacing: "0.14em"
  micro:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "9px"
    fontWeight: 500
    lineHeight: 1
    letterSpacing: "0.14em"
  stamp:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "0.625rem"
    fontWeight: 500
    lineHeight: 1
    letterSpacing: "0.12em"
  meta:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "10px"
    fontWeight: 500
    lineHeight: 1
    letterSpacing: "0.14em"
  index:
    fontFamily: "JetBrains Mono, ui-monospace, SFMono-Regular, Menlo, monospace"
    fontSize: "0.65rem"
    fontWeight: 500
    lineHeight: 1
    letterSpacing: "0.12em"
  helper:
    fontFamily: "Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "0.8125rem"
    fontWeight: 400
    lineHeight: 1.5
    letterSpacing: "normal"
  ui:
    fontFamily: "Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "0.875rem"
    fontWeight: 400
    lineHeight: 1.6
    letterSpacing: "normal"
  field:
    fontFamily: "Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "0.9375rem"
    fontWeight: 400
    lineHeight: 1.5
    letterSpacing: "normal"
  hero-body:
    fontFamily: "Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "0.975rem"
    fontWeight: 400
    lineHeight: 1.75
    letterSpacing: "normal"
  prose-h3:
    fontFamily: "Bricolage Grotesque, Instrument Sans, ui-sans-serif, system-ui, sans-serif"
    fontSize: "1.3rem"
    fontWeight: 600
    lineHeight: 1.2
    letterSpacing: "-0.02em"
rounded:
  none: "0"
  sm: "4px"
spacing:
  "2": "0.5rem"
  "4": "1rem"
  "6": "1.5rem"
  "8": "2rem"
  "10": "2.5rem"
  "16": "4rem"
  "24": "6rem"
components:
  button-primary:
    backgroundColor: "{colors.ink}"
    textColor: "{colors.paper-raised}"
    typography: "{typography.label}"
    rounded: "{rounded.none}"
    padding: "0.72rem 1rem"
  button-primary-hover:
    backgroundColor: "{colors.cobalt}"
    textColor: "{colors.paper-raised}"
  button-secondary:
    backgroundColor: "transparent"
    textColor: "{colors.ink}"
    typography: "{typography.label}"
    rounded: "{rounded.none}"
    padding: "0.72rem 1rem"
  button-danger:
    backgroundColor: "transparent"
    textColor: "{colors.stamp}"
    typography: "{typography.label}"
    rounded: "{rounded.none}"
    padding: "0.72rem 1rem"
  nav-link:
    backgroundColor: "transparent"
    textColor: "{colors.ink-soft}"
    typography: "{typography.ui}"
    rounded: "{rounded.none}"
    padding: "0.25rem 0"
  field:
    backgroundColor: "{colors.paper-raised}"
    textColor: "{colors.ink}"
    typography: "{typography.field}"
    rounded: "{rounded.sm}"
    padding: "0.7rem 0.8rem"
  filter-chip:
    backgroundColor: "transparent"
    textColor: "{colors.ink-soft}"
    typography: "{typography.stamp}"
    rounded: "{rounded.none}"
    padding: "0.5rem 0.7rem"
  stamp:
    backgroundColor: "{colors.cobalt-wash}"
    textColor: "{colors.cobalt}"
    typography: "{typography.stamp}"
    rounded: "{rounded.none}"
    padding: "0.28rem 0.5rem"
  ledger-row:
    backgroundColor: "transparent"
    textColor: "{colors.ink}"
    rounded: "{rounded.none}"
    padding: "1.1rem 0"
  sheet:
    backgroundColor: "{colors.paper-raised}"
    textColor: "{colors.ink}"
    rounded: "{rounded.none}"
    padding: "0"
---

# Design System: Fikri Amrullah — Build Log

## Overview

**Creative North Star: "The Build Log"**

This is a developer portfolio presented as a working field notebook: a ruled sheet on a cool paper ground, with graphite text, cobalt annotations, manila index tabs, and stamped statuses. The system is editorial rather than decorative. Its density comes from useful metadata — dates, categories, stack names, plate numbers, page counts — while the reading areas stay open and calm. The page should feel like a document someone actually maintains, not a marketing template dressed as one.

The world refuses the category defaults: no centered hero, no badge row, no equal-card project grid, and no rounded SaaS panels. Work is organized as ledger entries with rules between them, and technical drawings are treated as first-class content. Cobalt is the annotation ink: it marks links, active states, index numbers, and the one action that matters on a screen. It is never a large background wash.

The material palette is warm and low-chroma, with soft paper-lift shadows reserved for raised sheets and hover states. Thin warm-gray rules do most of the structural work. Typography pairs a characterful grotesk display with a readable sans and a mono face reserved for metadata, measurements, and code. Placeholder content is visibly provisional and never dressed as a real client outcome.

**Key Characteristics:**
- Cool paper ground with a faint drafting grid on section headers and technical plates.
- Graphite ink for reading, cobalt for annotation and interaction, manila for index tabs.
- Ledger rows and ruled sheets instead of card grids and rounded panels.
- A 3/9 editorial split with a sticky left margin for section index and context.
- Mono metadata at small sizes, with generous space around display type.
- Soft, offset paper-lift shadows; 1px warm rules are the default separator.

## Colors

A warm, low-chroma paper palette interrupted by a single measured cobalt annotation and a small set of stamped status colors.

### Primary
- **Annotation Cobalt** (#1f4ed8): Links, active navigation, index numbers, focus rings, the primary action, and the cobalt stroke in technical diagrams. It is the only saturated color used at scale.
- **Deep Annotation** (#173aa8): Hover text on cobalt-wash surfaces and small type that needs more weight against a pale blue ground.
- **Cobalt Wash** (#e8edfb): Selected navigation rows, stamp backgrounds, and the controller node in diagrams. A surface tint, never a page background.

### Secondary
- **Status Stamp** (#b4432f): Errors, destructive actions, required-field markers, and the “stamp” treatment for exceptions. Used sparingly and always with a border or label.
- **Stamp Wash** (#f3e4df): The quiet ground behind error stamps and validation callouts.

### Tertiary
- **Index Manila** (#e7dcc2): Index tabs, “Contoh” stamps, and the tape detail on plates. It signals provisional or indexed material.
- **Manila Edge** (#d8c8a4): Borders and deeper edges for manila surfaces.
- **Manila Ink** (#6f5c33): Text on manila stamps, index tabs, and tape details; dark enough for small mono labels.
- **Verified Green** (#2f6b4f): Success stamps and “Pilihan” status only.
- **Verified Wash** (#e6f0e9): Background for success stamps and the authored check icon.

### Neutral
- **Cool Paper** (#f5f3ec): The page ground. Not pure white; it keeps long reading sessions comfortable.
- **Raised Paper** (#fbfaf6): Sheets, fields, plates, and raised surfaces that need to separate from the ground.
- **Deep Paper** (#ebe7db): Table headers, sheet headers, and recessed metadata strips.
- **Graphite Ink** (#15181b): Primary text, dark sections, and the primary button ground.
- **Soft Graphite** (#4c5258): Body copy, descriptions, and secondary labels.
- **Faint Graphite** (#5f666c): Metadata, helper text, and placeholders. Kept dark enough for small-size contrast.
- **Warm Rule** (#d8d4c7): Default 1px separators and table rules.
- **Strong Rule** (#b9b4a5): Field borders, stronger dividers, and inactive control outlines.

### Named Rules

**The Annotation Rule.** Cobalt is ink, not paint. It appears on links, active states, index numbers, focus rings, and one primary action per screen; it does not fill large sections or become a decorative gradient.

**The Paper Rule.** No pure white and no pure black. Grounds are warm paper, raised surfaces are lighter paper, and reading text is graphite. If a surface needs separation, add a 1px warm rule before adding a shadow.

**The Stamp Rule.** Status colors are for stamps, inline validation, and small state markers. A red or green surface never becomes the background of a full section.

## Typography

**Display Font:** Bricolage Grotesque (with Instrument Sans, ui-sans-serif, system-ui, sans-serif)
**Body Font:** Instrument Sans (with ui-sans-serif, system-ui, sans-serif)
**Label/Mono Font:** JetBrains Mono (with ui-monospace, SFMono-Regular, Menlo, monospace)

**Character:** Bricolage Grotesque gives the log its authored, slightly mechanical voice; Instrument Sans keeps long Indonesian copy readable; JetBrains Mono behaves like the handwritten labels on a technical sheet — present, precise, and never asked to carry a paragraph.

### Hierarchy
- **Display** (600, clamp(3.4rem, 7vw, 6rem), 0.94): The home-page name and the largest statements. Tracking is tight (-0.04em); the display face is never used for body copy.
- **Headline** (600, clamp(2.4rem, 4.5vw, 4rem), 0.94): Section headings and page titles. Balanced wrapping is on; headlines are set to break at phrase boundaries, not arbitrary words.
- **Title** (600, 1.75rem, 1.1): Sheet headings, project-row titles, and admin panel titles. The project ledger scales this up to clamp(1.7rem, 3vw, 2.6rem) for entry titles.
- **Body** (400, 1.0625rem, 1.75): Long-form case-study copy, capped at 68ch. UI body copy uses 0.875–1rem with a 1.5–1.75 line height.
- **Label** (500, 0.6875rem, 0.14em, uppercase): Metadata, field labels, table headers, stamps, and index numbers. Mono is always a label voice, never a reading voice.

### Type Ramp

The literal steps used by the shipped components, from smallest annotation to display:

- **9px (0.5625rem)** — micro mono metadata in plate captions, stamp details, and dense admin labels. Used only with uppercase tracking.
- **10px (0.625rem)** — top-strip metadata, plate numbers, and compact admin table labels; the same 0.625rem step used by stamps and filter chips.
- **0.65rem (10.4px)** — index-tab and narrow mono labels where a 10px step would be too tight.
- **0.6875rem (11px)** — the standard mono label step (eyebrow, field labels, buttons).
- **0.8125rem (13px)** — helper text, inline validation, and small admin descriptions.
- **0.875rem (14px)** — navigation links, UI body copy, and table body.
- **0.9375rem (15px)** — form fields and compact reading copy.
- **0.975rem (15.6px)** — the hero supporting paragraph, slightly larger than UI body.
- **1.0625rem (17px)** — long-form body copy, capped at 68ch.
- **1.3rem (20.8px)** — prose h3 inside case-study copy.
- **1.75rem (28px)** — the title role; project ledger titles scale to clamp(1.7rem, 3vw, 2.6rem).
- **clamp(2.4rem, 4.5vw, 4rem)** — the headline role.
- **clamp(3.4rem, 7vw, 6rem)** — the display role.

### Named Rules

**The Mono-Is-Metadata Rule.** JetBrains Mono is reserved for code, dates, measurements, statuses, table headers, and short labels. It never sets a paragraph, a project summary, or a marketing sentence.

**The Tight Display Rule.** Display and headline tracking never goes looser than -0.025em, and display line-height stays at 0.94. If a heading needs more room, shorten the line or reduce the size; do not loosen the tracking.

**The Two-Voice Rule.** The system has two reading voices: display for statements and Instrument Sans for explanation. Mono is the annotation layer. Do not introduce a third reading face.

## Layout

The public site uses a 1440px maximum container with 20px gutters on mobile, 32px at `sm`, and 48px at `lg`. The core editorial grid is 12 columns. Section headers and page introductions use a 3/9 split: a sticky left margin for the section index, status, and short context, with the heading and content in the right nine columns. The home hero uses a 7/5 split so the name and statement occupy the left field while the system map and field note occupy the right.

Projects are not a card grid. The index is a ledger: a 1px rule above and below each row, with the entry number in the first column, the case-study summary in the middle, and a technical plate on the right. On mobile the ledger collapses to a single column while preserving the number, stamps, title, summary, and plate. The public navigation is sticky; the top metadata strip (location / role / build-log number) stays visible above it.

Section rhythm is deliberately uneven: 4rem vertical padding on mobile and 6rem on desktop, with 1.5–2.5rem gaps inside a section and 0.5–1rem gaps inside metadata groups. Reading measures are capped at 58–68ch. The admin area uses a fixed 250px sidebar at `lg` and a 1190px main column at 1440px; below `lg` the sidebar becomes a full-width disclosure panel.

### Named Rules

**The Ledger Rule.** Project work is presented as ruled rows with numbers, stamps, summaries, and plates. It is never an equal-card grid, and no project is promoted with a larger card unless it is a featured entry inside the ledger.

**The Margin-Note Rule.** Section index and context live in the left margin, not as a kicker above the heading. The heading starts the reading column; the margin explains where the reader is.

**The One-Screen Rule.** Every public screen has one obvious next action. Secondary actions are quieter buttons or text links; they do not compete with the primary action.

## Elevation & Depth

The system is a hybrid of flat tonal layering and soft paper lift. Most surfaces are flat: 1px warm rules, paper-deep headers, and paper-raised panels do the separating. Raised sheets use `--shadow-sheet`, a 1px contact shadow plus a wide, low-opacity ambient shadow, so they read as paper resting on paper rather than floating UI. Plates use `--shadow-lift` on hover to suggest a sheet being picked up. Stamps use `--shadow-stamp`, a single 1px contact shadow that makes the small bordered label feel pressed onto the page.

Depth is never signaled by a colored halo, a blur, or a zero-offset glow. Dark sections invert the material: graphite ground, paper text, and paper/20 rules. The dark contact section is the only full-bleed dark surface on the public site.

### Shadow Vocabulary
- **Sheet** (`box-shadow: 0 1px 0 rgb(21 24 27 / 0.06), 0 18px 40px -28px rgb(21 24 27 / 0.28)`): Raised forms, contact sheets, and the login card.
- **Lift** (`box-shadow: 0 2px 0 rgb(21 24 27 / 0.04), 0 10px 24px -16px rgb(21 24 27 / 0.25)`): Hover state for plates and interactive raised elements.
- **Stamp** (`box-shadow: 0 1px 0 rgb(21 24 27 / 0.08)`): Small status stamps and index tabs.

### Named Rules

**The Paper-Lift Rule.** Shadows are soft, offset, and low-opacity. At rest, a surface is flat unless it is a sheet or a plate; hover may lift it by one step, never by a theatrical jump.

**The One-Sheet Rule.** A section gets at most one raised sheet. Nested panels use `sheet-flat` with a 1px border and no shadow, so the hierarchy stays legible.

## Shapes

The form language is square, ruled, and clipped. Buttons, stamps, tabs, plates, and sheets have no border radius; fields are the only common control with a 4px radius. Borders are 1px warm gray, and the default separator is a full-width rule rather than a card outline. Plates clip their contents with `overflow: hidden`; the technical diagram fills the frame edge to edge. The manila tape detail is a small rotated strip, not a decorative blob.

Corners are not softened to signal friendliness. The system's warmth comes from paper color, type, and spacing, not from pills and large radii.

### Named Rules

**The Ruled-Sheet Rule.** Every container is defined by a 1px warm rule, a paper fill, or both. If a container needs a border radius larger than 4px, it is probably the wrong component.

**The Plate Rule.** Technical drawings are framed as plates: 1px border, paper-deep ground, plate number, category label, and a bottom metadata strip. They are content, not decoration.

## Components

### Buttons
- **Shape:** Square (0 radius), 1px border, mono uppercase label at 0.6875rem with 0.1em tracking.
- **Primary:** Graphite ground with paper-raised text; padding 0.72rem 1rem. Hover shifts the ground and border to cobalt. Active state translates down 1px.
- **Secondary:** Transparent ground, graphite text, strong-rule border. Hover raises the paper and darkens the border to graphite.
- **Danger:** Transparent ground, stamp text, stamp-tinted border; hover fills with stamp and switches to paper text.
- **Hover / Focus:** 160ms ease-out color and border transitions; global focus-visible outline is 2px cobalt with 3px offset. Reduced-motion users get near-instant transitions.

### Chips
- **Style:** Rectangular filter chips with a 1px strong-rule border, transparent ground, mono 0.625rem uppercase text, and 0.5rem 0.7rem padding.
- **State:** Unselected is soft graphite; hover darkens the border and text; selected (`aria-pressed="true"`) fills with graphite and uses paper-raised text. Chips are filters, not tags.

### Cards / Containers
- **Corner Style:** Square (0 radius).
- **Background:** Raised Paper for sheets; Deep Paper for headers and recessed metadata; Cool Paper for the page ground.
- **Shadow Strategy:** `sheet` for one raised sheet per section; `sheet-flat` for nested panels; no shadow on ledger rows.
- **Border:** 1px Warm Rule; Strong Rule for fields and stronger dividers.
- **Internal Padding:** 1–1.5rem for sheets; 1.1rem block padding for ledger rows.

### Inputs / Fields
- **Style:** Raised Paper ground, 1px Strong Rule border, 4px radius, 0.7rem 0.8rem padding, 0.9375rem text.
- **Focus:** Cobalt border plus a 3px `rgb(31 78 216 / 0.12)` ring; the native outline is removed only when this ring is present.
- **Error / Disabled:** Error fields switch the border to Status Stamp and pair with a stamp-colored message; disabled fields keep the paper ground but lower contrast.

### Navigation
- **Style:** Sticky header with a top metadata strip and a second row for the wordmark, desktop nav, and actions. Nav links are 0.875rem Instrument Sans with a 1px cobalt underline that scales from the left on hover and `aria-current="page"`.
- **Mobile:** The desktop nav and actions are hidden below `lg`; a bordered “Menu” button toggles a full-width disclosure panel. The panel uses the `hidden` class, not the HTML `hidden` attribute, so responsive utilities and the toggle can coexist.
- **Admin:** A 250px sidebar at `lg`, sticky below the top bar, with active rows marked by a cobalt-wash fill, deep-cobalt text, and a 1px cobalt left rule. Below `lg` the same panel is a disclosure above the main content.

### Signature Components

**System Map.** A Laravel request path drawn as a field diagram: request → route → controller → model → MySQL → Blade → response. Hairline cobalt traces, mono labels, and a `Ulangi alur` control that replays the line-drawing animation. The diagram is the first-viewport proof of how the developer thinks; on mobile it becomes a numbered list.

**Project Plate.** A technical thumbnail or authored SVG diagram framed as a plate, with a plate number, category stamp, stack count, and “Contoh” / “Log” marker. It is the visual evidence attached to each ledger entry, not a stock image card.

**Ledger Row.** A 12-column row with entry number and year, stamps, display title, summary, stack metadata, and a plate. It uses 1px rules and whitespace instead of a card boundary.

**Status Stamp.** A rectangular bordered label with mono uppercase text and a 1px contact shadow. Variants: cobalt (category), manila (placeholder), stamp (error), success (featured). Stamps are small, sparse, and always readable.

## Do's and Don'ts

### Do:
- **Do** keep the page on Cool Paper and use Raised Paper only for sheets, fields, and plates.
- **Do** use Annotation Cobalt for links, active states, index numbers, focus rings, and one primary action per screen.
- **Do** set section context in the 3-column left margin and start the heading in the reading column.
- **Do** use 1px warm rules as the default separator; reach for a shadow only when a sheet or plate needs lift.
- **Do** set mono labels at 0.6875rem or smaller with 0.14em tracking, and keep paragraphs in Instrument Sans.
- **Do** keep the drafting grid faint (4.5% ink) and use it on section headers and plates, not behind long-form body copy.
- **Do** label placeholder projects with the “Contoh” stamp and keep their copy explicitly provisional.
- **Do** honor `prefers-reduced-motion` by collapsing transitions and diagram animations to near-instant.

### Don't:
- **Don't** use pure white or pure black; the palette is paper and graphite.
- **Don't** turn the project index into an equal-card grid or a gallery of screenshots.
- **Don't** put a kicker or eyebrow directly above a heading; use the left margin or a metadata strip instead.
- **Don't** use a colored left border thicker than 1px on cards, callouts, alerts, or list items.
- **Don't** fill large sections with cobalt, stamp red, or success green; those are annotation and status inks.
- **Don't** use rounded SaaS cards, pills, or radii above 4px for standard containers.
- **Don't** use mono for paragraphs, project summaries, or marketing copy.
- **Don't** invent clients, metrics, testimonials, or outcomes for placeholder projects.
