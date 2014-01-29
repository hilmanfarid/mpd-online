<Page id="1" templateExtension="html" relativePath=".." fullRelativePath=".\main" secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" isService="False" cachingEnabled="False" cachingDuration="1 minutes" wizardTheme="RWNet" wizardThemeVersion="3.0" needGeneration="0">
	<Components>
		<Record id="24" sourceType="Table" urlType="Relative" secured="False" allowInsert="False" allowUpdate="False" allowDelete="False" validateData="True" preserveParameters="GET" returnValueType="Number" returnValueTypeForDelete="Number" returnValueTypeForInsert="Number" returnValueTypeForUpdate="Number" connection="ConnSIKP" name="p_pass_byadminForm" dataSource="p_app_user" errorSummator="Error" wizardCaption="Add/Edit V P Module Role " wizardFormMethod="post" PathID="p_pass_byadminForm" pasteAsReplace="pasteAsReplace" pasteActions="pasteActions" activeCollection="USPParameters" activeTableType="p_app_user" parameterTypeListName="ParameterTypeList" returnPage="p_app_user.ccp">
			<Components>
				<Button id="26" urlType="Relative" enableValidation="True" isDefault="False" name="Button_Ubah" wizardCaption="Submit" PathID="p_pass_byadminFormButton_Ubah" removeParameters="FLAG">
					<Components/>
					<Events>
						<Event name="OnClick" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="104"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Button>
				<TextBox id="33" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="n_user_pwd1" required="False" caption="n_user_pwd1" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_pass_byadminFormn_user_pwd1">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Hidden id="34" fieldSourceType="DBColumn" dataType="Float" name="p_app_user_id" fieldSource="p_app_user_id" required="False" caption="p_app_user_id" wizardCaption="P Module Id" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_pass_byadminFormp_app_user_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<TextBox id="94" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="n_user_pwd2" required="False" caption="n_user_pwd2" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_pass_byadminFormn_user_pwd2">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Label id="101" fieldSourceType="DBColumn" dataType="Text" html="False" name="app_user_name" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_pass_byadminFormapp_user_name" fieldSource="app_user_name">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<TextBox id="103" visible="Yes" fieldSourceType="DBColumn" dataType="Text" name="o_user_pwd" required="False" caption="o_user_pwd" wizardCaption="P App Role Code" wizardSize="32" wizardMaxLength="32" wizardIsPassword="False" wizardUseTemplateBlock="False" PathID="p_pass_byadminFormo_user_pwd">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</TextBox>
				<Button id="105" urlType="Relative" enableValidation="True" isDefault="False" name="Button_cancel" wizardTheme="None" wizardThemeType="File" wizardThemeVersion="3.0" PathID="p_pass_byadminFormButton_cancel" operation="Cancel">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="30" conditionType="Parameter" useIsNull="False" field="app_user_name" dataType="Text" logicOperator="And" searchConditionType="Equal" parameterType="Expression" orderNumber="1" parameterSource="CCGetUserLogin()"/>
			</TableParameters>
			<SPParameters/>
			<SQLParameters/>
			<JoinTables>
				<JoinTable id="93" tableName="p_app_user" posLeft="10" posTop="10" posWidth="160" posHeight="180"/>
			</JoinTables>
			<JoinLinks/>
			<Fields/>
			<ISPParameters/>
			<ISQLParameters>
				<SQLParameter id="85" variable="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id"/>
				<SQLParameter id="86" variable="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id" defaultValue="0"/>
				<SQLParameter id="87" variable="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yy HH:nn:ss" defaultValue="&quot;&quot;" DBFormat="dd-mm-yyyy"/>
				<SQLParameter id="88" variable="description" dataType="Text" parameterType="Control" parameterSource="description"/>
				<SQLParameter id="89" variable="UserName" dataType="Text" parameterType="Session" parameterSource="UserName"/>
				<SQLParameter id="92" variable="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" defaultValue="&quot;&quot;" DBFormat="dd-mm-yyyy" format="dd-mmm-yy HH:nn:ss"/>
			</ISQLParameters>
			<IFormElements>
				<CustomParameter id="75" field="p_app_role_id" dataType="Float" parameterType="Control" parameterSource="p_app_role_id" omitIfEmpty="True"/>
				<CustomParameter id="77" field="p_app_user_id" dataType="Float" parameterType="Control" parameterSource="p_app_user_id" omitIfEmpty="True"/>
				<CustomParameter id="78" field="valid_from" dataType="Date" parameterType="Control" parameterSource="valid_from" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="79" field="description" dataType="Text" parameterType="Control" parameterSource="description" omitIfEmpty="True"/>
				<CustomParameter id="80" field="created_by" dataType="Text" parameterType="Session" parameterSource="UserName" omitIfEmpty="True"/>
				<CustomParameter id="81" field="updated_by" dataType="Text" parameterType="Session" parameterSource="UserName" omitIfEmpty="True"/>
				<CustomParameter id="82" field="creation_date" dataType="Date" parameterType="Expression" parameterSource="sysdate" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="83" field="updated_date" dataType="Date" parameterType="Expression" parameterSource="sysdate" format="dd-mmm-yyyy" omitIfEmpty="True"/>
				<CustomParameter id="84" field="valid_to" dataType="Date" parameterType="Control" parameterSource="valid_to" omitIfEmpty="True"/>
			</IFormElements>
			<USPParameters/>
			<USQLParameters>
			</USQLParameters>
			<UConditions>
				<TableParameter id="96" conditionType="Parameter" useIsNull="False" field="p_app_user_id" dataType="Float" searchConditionType="Equal" parameterType="Control" logicOperator="And" parameterSource="p_app_user_id"/>
			</UConditions>
			<UFormElements>
				<CustomParameter id="97" field="user_pwd" dataType="Text" parameterType="Control" omitIfEmpty="True" parameterSource="n_user_pwd1"/>
			</UFormElements>
			<DSPParameters/>
			<DSQLParameters>
				<SQLParameter id="53" variable="p_app_user_role_id" parameterType="Control" dataType="Float" parameterSource="p_app_user_role_id" defaultValue="0"/>
			</DSQLParameters>
			<DConditions>
				<TableParameter id="52" conditionType="Parameter" useIsNull="False" field="p_app_user_role_id" dataType="Float" parameterType="Control" searchConditionType="Equal" logicOperator="And" orderNumber="1" parameterSource="p_app_user_role_id"/>
			</DConditions>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
		</Record>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="p_change_pass_only_events.php" forShow="False" comment="//" codePage="windows-1252"/>
<CodeFile id="Code" language="PHPTemplates" name="p_change_pass_only.php" forShow="True" url="p_change_pass_only.php" comment="//" codePage="windows-1252"/>
</CodeFiles>
	<SecurityGroups/>
	<CachingParameters/>
	<Attributes/>
	<Features/>
	<Events>
		<Event name="OnInitializeView" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="100"/>
			</Actions>
		</Event>
	</Events>
</Page>
