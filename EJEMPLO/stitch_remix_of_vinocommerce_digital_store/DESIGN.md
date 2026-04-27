# Design System Documentation: The Editorial Cellar

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Digital Sommelier."** This is not a standard e-commerce template; it is a high-end editorial experience that mimics the tactile sensation of browsing a private cellar or a bespoke wine list at a Michelin-starred restaurant.

To break the "generic" digital mold, the design system utilizes **intentional asymmetry** and **tonal layering**. We move away from the rigid, boxed-in grids of traditional retail. Instead, we treat the screen as a canvas of fine parchment, where elements breathe through generous whitespace and overlap organically to create a sense of curated depth. Every interaction should feel intentional, artisanal, and slow—inviting the user to savor the content rather than rush to a checkout.

---

## 2. Colors: The Palette of Terroir
The color strategy avoids the clinical starkness of pure white and black. Instead, it draws from the organic tones of viticulture: fermented grapes, aged barrels, and vintage labels.

### Surface Hierarchy & Nesting
This system rejects the "flat" web. We use a hierarchy of surfaces to create a physical sense of depth.
- **Base Layer:** `surface` (#fbfbe2) acts as our cream parchment canvas.
- **Sectioning:** Use `surface-container-low` (#f5f5dc) for secondary content blocks.
- **Prominence:** Use `surface-container-highest` (#e4e4cc) to draw the eye to featured collections or tasting notes.

### The "No-Line" Rule
**Explicit Instruction:** Designers are prohibited from using 1px solid borders to define sections. Separation must be achieved through:
1.  **Background Shifts:** Transitioning from `surface` to `surface-container-low`.
2.  **Generous Spacing:** Using the 64px or 80px scale to let elements stand alone.
3.  **Tonal Transitions:** Soft gradients between `primary` and `primary_container`.

### Signature Textures & Glassmorphism
To elevate the "premium" feel, use **Glassmorphism** for floating navigation bars or wine filter overlays.
- **Token:** `surface_variant` (#e4e4cc) at 70% opacity with a `24px` backdrop blur.
- **CTAs:** Primary buttons should use a subtle vertical gradient from `primary` (#2a0002) to `primary_container` (#4a0e0e) to mimic the depth of a deep red wine.

---

## 3. Typography: Editorial Authority
The typography system relies on a high-contrast pairing between a sophisticated serif and a functional, modern sans-serif.

### Serif: Noto Serif (The Voice)
Used for all `display` and `headline` roles. This font communicates heritage and artisanal quality.
- **Display LG (3.5rem):** Reserved for hero titles and high-impact editorial statements. 
- **Headline MD (1.75rem):** Used for product names and cellar categories.
*Design Note: Use slightly tighter letter-spacing (-0.02em) on Display styles to achieve a high-fashion editorial look.*

### Sans-Serif: Manrope (The Guide)
Used for `title`, `body`, and `label` roles. Manrope provides a clean, contemporary counterpoint to the serif, ensuring technical wine specs and prices remain legible.
- **Body LG (1rem):** Primary reading weight for tasting notes and vineyard stories.
- **Label MD (0.75rem):** Used for vintage years, ABV percentages, and secondary metadata.

---

## 4. Elevation & Depth: Tonal Layering
In this design system, elevation is a feeling, not a drop shadow. We convey importance through **Tonal Layering**.

- **The Layering Principle:** Instead of traditional shadows, "stack" your containers. Place a `surface_container_lowest` (#ffffff) card onto a `surface_container_low` (#f5f5dc) background. This creates a "lifted" parchment effect that feels natural and premium.
- **Ambient Shadows:** Where floating elements (like a luxury cart drawer) are necessary, use a shadow with a `40px` blur at `6%` opacity. The shadow color must be tinted with the `on_surface` (#1b1d0e) token—never pure black—to simulate soft, ambient room lighting.
- **The Ghost Border Fallback:** If a boundary is required for accessibility in forms, use the `outline_variant` (#dac1bf) at **15% opacity**. High-contrast borders are strictly forbidden as they break the "artisanal" aesthetic.

---

## 5. Components: Artisanal Implementation

### Buttons (The "Seal")
- **Primary:** Deep Burgundy (#2a0002). Roundedness: `md` (0.375rem). Text: `label-md` in all caps with 0.1em tracking.
- **Secondary:** Aged Oak (#745853). Use for "Add to Cellar" actions.
- **Tertiary:** Gold Accent (#735c00). Text-only with a subtle underline in `tertiary_fixed_dim`.

### Cards & Product Lists
- **Rule:** No dividers. Separate product items using vertical whitespace or a subtle change to `surface_container_low`.
- **Imagery:** Product images should be high-resolution, featuring a "soft-focus" background or a "cut-out" style that allows the bottle to overlap the text layers behind it.

### Input Fields
- **Style:** Minimalist. No bounding box. Only a bottom stroke using `outline_variant` at 20% opacity. 
- **Focus State:** The stroke transitions to `tertiary` (Gold) at 100% opacity.

### Selection Chips (Vintages/Regions)
- Use `surface_container_high` with `on_surface` text. When selected, transition to `primary` with `on_primary` text. Corners should be `full` (pill-shaped) for a softer, organic feel.

---

## 6. Do's and Don'ts

### Do:
- **Embrace Asymmetry:** Let a wine bottle image bleed off the edge of the screen or overlap a headline.
- **Use Large Margins:** A luxury experience requires "breathing room." If it feels too crowded, double the spacing.
- **Mix Tones:** Place `tertiary` (Gold) accents sparingly—only for the most important calls to action or "Premium/Rare" badges.

### Don't:
- **Don't use 100% Black:** It is too harsh for the parchment aesthetic. Use `on_surface` (#1b1d0e).
- **Don't use Standard Grids:** Avoid 4-column product grids. Try a staggered 2-column or 3-column layout with varying image heights.
- **Don't use Hard Corners:** Avoid `rounded-none`. Use `sm` or `md` to maintain the "soft touch" of premium paper and aged wood.
- **Don't use Divider Lines:** If you feel the need for a line, use a 24px gap of white space instead.