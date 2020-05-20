# CSS Property Glossary

## How this works
Go leverages CSS custom properties – also referred to as CSS variables — to make it easier to extend the design of the theme. The CSS properties Go uses are configured via the following format: `--go--{target}--{propertyName}`, where `{target}` is the element we're wanting to style, while `{propertyName}` is the specific CSS property to modify.

### Example:
To target the text alignment of each caption, you'd use `--go--caption--text-align`, setting the value to either `left`, `right`, or `center`:

```css
:root {
	--go--caption--text-align: center;
}
```


## CSS Properties
Here are properties that may be leveraged within design style stylesheets:

| Structure  | Description |
| ------------- | ------------- |
| --go--max-width  | Standard page content width |
| --go--max-width--alignwide | Wide alignment content width |
| --go--spacing--header | Site header XY spacing |
| --go--spacing--horizontal | Horizontal viewport spacing |
| --go--spacing--paragraph | Paragraph spacing |
| --go--viewport-basis | Global site spacing basis |


### Typography
| Typography  | Description |
| ------------- | ------------- |
| --go--color--text | Global text color|
| --go--font-family | Global font family applied|
| --go--font-size | Base body text size, in `rem` |
| --go--font-size--small | Text size for smaller elements, such as captions |
| --go--line-height | Base body line height/leading |
| --go--type-ratio | [Typography ratio](https://type-scale.com) by which the heading sizes are generated, example `1.3` |


### Formatting
| Hyperlinks  | Description |
| ------------- | ------------- |
| --go--hyperlink--color--text | Link default color |
| --go--hyperlink-interactive--color--text | Link hover/focus color |

| Captions  | Description |
| ------------- | ------------- |
| --go-caption--color--text | Text color for all captions |
| --go-caption--font-size | Font size for captions |
| --go-caption--text-align | Text alignment for captions: right, left, center |
| --go-caption--text-align--rtl | Text alignment for RTL langauges|


### Forms

| Labels  | Description |
| ------------- | ------------- |
| --go-label--font-size | Font size for <label> |
| --go-label--font-weight | Font weight for <label> |
| --go-label--letter-spacing | Letter spacing for <label> |
| --go-label--margin-bottom | Space between label and the input below it |

| Inputs  | Description |
| ------------- | ------------- |
| --go-input--border | Border for inputs, example: 1px solid black|
| --go-input--color--text | Text color for input fields |
| --go-input--margin-bottom | Space between the input and elements below |
| --go-input--padding--x | Horizontal padding for field inputs |
| --go-input--padding--y | Vertical padding for field inputs |

| Buttons  | Description |
| ------------- | ------------- |
| --go-button--border-radius | Rounded corners, example `3px` |
| --go-button--font-size | Font size for button text |
| --go-button--font-weight | Font weight, examplel `400` |
| --go-button--letter-spacing | Letter spacing |
| --go-button--padding--x | Horizontal padding for field inputs |
| --go-button--padding--y | Vertical padding for field inputs |
| --go-button--text-transform | Button text transformation, example `uppercase` |
| --go-button-interactive--color--background | Button hover/focus background color |


### Elements

| Site Navigation  | Description |
| ------------- | ------------- |
| --go-navigation--color--text | Text color for site navigation |
| --go-navigation--font-family | Font family for site navigation |
| --go-navigation--font-size | Font size for site navigation menu items |
| --go-navigation-mobile--font-size | Font size for the mobile navigation menu items |
| --go-navigation--font-weight ||
| --go-navigation--text-transform ||
| --go-navigation--letter-spacing ||
