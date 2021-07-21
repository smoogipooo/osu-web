<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\User;

use App\Exceptions\UserProfilePageLookupException;
use App\Models\User;

class FindForProfilePage
{
    public static function find($id, ?string $type = null, ?bool $assertCanonicalId = null)
    {
        $user = User::lookupWithHistory($id, $type, true);
        $request = request();

        if ($user === null || !priv_check('UserShow', $user)->can()) {
            throw new UserProfilePageLookupException(function () {
                if (is_json_request()) {
                    abort(404);
                }

                return ext_view('users.show_not_found', null, null, 404);
            });
        }

        if (($assertCanonicalId ?? !is_json_request()) && (string) $user->getKey() !== (string) $id) {
            $redirectTarget = route(
                $request->route()->getName(),
                array_merge($request->query(), $request->route()->parameters(), compact('user'))
            );

            throw new UserProfilePageLookupException(fn () => ujs_redirect($redirectTarget));
        }

        return $user;
    }
}
