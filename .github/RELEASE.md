# Release a New Version

This document walks you though how to run a release, which is mostly automated, but requires a few manual inputs and steps to ensure the release runs smoothly.

## Create a Milestone

Creating a Milestone is the first step for releasing a new version, as closing the Milestone will trigger the [Release Action Workflow](.github/workflows/create-release.yml), which tags the new version and creates the release.

Each new Milestone MUST have a title (semver tag number) and a description (markdown), which are transposed into the tag name, release title and description within the workflow.

__Title Requirements:__
1. Title MUST match a semver format.
2. Title MUST NOT be a tag that already exists in the repo.

### Pull Requests and Issues

At a minimum, a Milestone MUST include the related Pull Request with incoming changes. In addition, it is required that all related Issues and Pull Requests  including changes be attached to the Milestone. This ensures clear understanding of what is changing.

Furthermore, both Pull Requests and Issues MUST be closed (or moved) prior to the Milestone close, and the Milestone itself MUST show a 100% completion before closing.

1. Pull Requests MUST be merged, or moved to another Milestone.
2. Issues MUST be closed, or moved to another Milestone.

> :bulb: HOTTIP — Closing an issue with a pull request is recommended, and can be automated using [GitHub's linking keywords](https://docs.github.com/en/issues/tracking-your-work-with-issues/linking-a-pull-request-to-an-issue#linking-a-pull-request-to-an-issue-using-a-keyword).


## Close Milestone

Once all the Pull Requests and Issues are closed (or moved), the Milestone will show a 100% completion, and it is then ready to close. Closing the Milestone will trigger the Release Workflow, which will build and bundle the theme, tag a new version, and create a new Release on GitHub.

## Upload to [WordPress](https://wordpress.org/themes/upload/) (human)

From the newly created release, grab the `go.zip` from the assets and upload it to [WordPress.org](https://wordpress.org/themes/upload/).
